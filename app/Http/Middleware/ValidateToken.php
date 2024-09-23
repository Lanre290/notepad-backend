<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ValidateToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'token_not_provided'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            // Optionally, you can attach the decoded info to the request
            $request->attributes->add(['user' => $decoded]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'invalid_token'], 401);
        }

        return $next($request);
    }
}
