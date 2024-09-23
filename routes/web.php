<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Http\Controllers\Views;


Route::get('/note', [Views::class, 'notes'])->middleware('validate.token');
Route::get('/note/{id}', [Views::class, 'notes'])->middleware('validate.token');
Route::post('/delete/{id}', [UserActions::class, 'delete'])->middleware('validate.token');
Route::post('/create', [UserActions::class, 'createNote'])->middleware('validate.token');
Route::post('/save', [UserActions::class, 'updateNote'])->middleware('validate.token');




// Route::get('/jwt', function () {
//     // $credentials = $request->only('email', 'password');
//     // $credentials = ['email' => , 'password' => '20838'];

//     $email = 'lanre2967@gmail.com';
//     $refreshPayload = [
//         'sub' => $email,
//         'exp' => now()->addDays(7)->timestamp, 
//     ];

//     $refreshToken = JWT::encode($refreshPayload, env('JWT_SECRET'), 'HS256');

//     return response()->json(['token' => $refreshToken]);
// });


// Route::get('protected-route', [YourController::class, 'yourMethod'])->middleware('validate.token');
