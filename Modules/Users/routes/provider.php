<?php

use \Illuminate\Support\Facades\route;
use Modules\Users\Http\Controllers\Provider\TimesController;

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::apiResource('times', TimesController::class);
    });
