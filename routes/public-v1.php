<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\General\V1\AuthController;

Route::post('login', [AuthController::class, 'loginUsingPasswordGrant'])->name('login');
