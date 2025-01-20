<?php

namespace Laravelwebdev\Updater\Http\Controllers;

use Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;

class UpdaterController
{
    public function __invoke(): JsonResponse
    {
        Artisan::call('simpede:update');
        $output = Artisan::output();
        return response()->json(['status' => $output]);
    }

}