<?php

use Illuminate\Support\Facades\Route;
use Modules\Bookings\Http\Controllers\Provider\BookingsController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('bookings', BookingsController::class)->only(['index', 'show']);
    Route::post('{booking}/update-status', [BookingsController::class, 'updateStatus']);
});
