<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Customer\ProvidersController;

Route::group(['middleware' => ['api', 'auth:sanctum']], function () {
    Route::apiResource('providers', ProvidersController::class)
        ->only(['index', 'show']);
});
