<?php

use Illuminate\Support\Facades\Route;
use Modules\Bookings\Http\Controllers\Customer\BookingsController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('bookings', BookingsController::class)->only(['index', 'store', 'show']);
});
