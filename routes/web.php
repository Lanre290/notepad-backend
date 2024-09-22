<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('/api')->group(function(){
    // Authentication routes
    Route::post('auth/signup', [AuthController::class, 'signup'])->name('api/auth/signup');
    Route::post('auth/login', [AuthController::class, 'login'])->name('api/auth/login');
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('api/auth/logout');
});

Route::get('/api/csrf', function(){
    return csrf_token();
});

