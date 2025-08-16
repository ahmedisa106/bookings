<?php

use Illuminate\Support\Facades\Route;
use Modules\Services\Http\Controllers\Provider\ServicesController;

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::apiResource('services', ServicesController::class);
        Route::post('services/{service}/update-status', [ServicesController::class, 'updateStatus']);
    });
