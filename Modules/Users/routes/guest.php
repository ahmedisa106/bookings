<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\Auth\LoginController;

Route::post('login', LoginController::class);
