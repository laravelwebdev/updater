<?php

namespace Laravelwebdev\Updater\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Artisan;

class UpdaterController
{
    public function __invoke(): JsonResponse
    {
        $error = false;
        try {
            Artisan::call('maintenance', ['action' => 'start']);
            $process = new Process(['git', 'pull', 'origin', 'main']);
            $process->run();
            if (! $process->isSuccessful()) {
                $error = true;
            }
            $composer = config('app.composer');
            $home = config('app.composer_home');
            $process = Process::fromShellCommandline("$composer update --no-dev", base_path(), ['COMPOSER_HOME' => $home]);
            $process->run();
            if (! $process->isSuccessful()) {
                $error = true;
            }

            $process = Process::fromShellCommandline("$composer clear-cache", base_path(), ['COMPOSER_HOME' => $home]);
            $process->run();
            if (! $process->isSuccessful()) {
                $error = true;
            }
        } finally {
            Artisan::call('maintenance', ['action' => 'stop']);
            Artisan::call('optimize:clear');
            Artisan::call('optimize');
            Artisan::call('simpede:cache');
            if (! is_link(public_path('storage'))) {
                Artisan::call('storage:link');
            }

        }
        return response()->json(['status' => $error]);
    }

}