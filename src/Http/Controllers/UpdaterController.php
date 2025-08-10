<?php

namespace Laravelwebdev\Updater\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Helpers\SimpedeUpdater;

class UpdaterController
{
    public function __invoke(): JsonResponse
    {
       $status = SimpedeUpdater::update();
        return response()->json(['status' => $status]);
    }

}