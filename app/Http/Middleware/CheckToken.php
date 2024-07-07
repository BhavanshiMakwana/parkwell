<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // return $next($request);
        try {
            $token = JWTAuth::parseToken();
            $user = $token->authenticate();

            if (!$user) {
                return response()->json(['status' => false, 'message' => 'User not found'], 404);
            }
        } catch (Exception $e) {
            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => false, 'message' => 'Invalid token'], 401);
            } else if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => false, 'message' => 'Token expired'], 401);
            } else if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException) {
                return response()->json(['status' => false, 'message' => 'Token not provided'], 400);
            } else {
                return response()->json(['status' => false, 'message' => 'An error occurred'], 500);
            }
        }

        return $next($request);
    }
}
