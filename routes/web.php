<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


Route::get('/jwt', function () {
    // $credentials = $request->only('email', 'password');
    // $credentials = ['email' => , 'password' => '20838'];

    $email = 'lanre2967@gmail.com';
    $refreshPayload = [
        'sub' => $email,
        'exp' => now()->addDays(7)->timestamp, 
    ];

    $refreshToken = JWT::encode($refreshPayload, env('JWT_SECRET'), 'HS256');

    return response()->json(['token' => $refreshToken]);
});

Route::get('/check', function () {
    try {
        $decoded = JWT::decode('fef.fefe.fef', new Key(env('JWT_SECRET'), 'HS256')); // Use your JWT secret
        // If needed, check additional claims or user info here
        return response()->json(['decoded' => $decoded]);
    } catch (Exception $e) {
        return response()->json(['error' => 'invalid_token'], 401);
    }
});

// Route::get('protected-route', [YourController::class, 'yourMethod'])->middleware('validate.token');
