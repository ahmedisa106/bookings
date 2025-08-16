<?php

use Illuminate\Support\Facades\Route;
use Modules\Bookings\Http\Controllers\Admin\BookingsController;

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('bookings', [BookingsController::class, 'bookings']);
});
