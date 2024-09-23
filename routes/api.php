<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    // Authentication routes
Route::post('auth/signup', [AuthController::class, 'signup'])->name('api/auth/signup');
Route::post('auth/login', [AuthController::class, 'login'])->name('api/auth/login');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('api/auth/logout');

Route::get('/csrf', function(){
    return csrf_token();
});