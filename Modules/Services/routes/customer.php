<?php

use Illuminate\Support\Facades\Route;
use Modules\Services\Http\Controllers\Customer\ServicesController;

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::apiResource('services', ServicesController::class)->only(['index', 'show']);
        Route::get('services/{service}/available-times', [ServicesController::class, 'availableTimes']);
    });
