<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UsersController;

Route::middleware(['auth:sanctum'])
    ->group(function () {
        Route::get('profile', [UsersController::class, 'profile']);
    });
