<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token no proporcionado'], 401);
        }

        $token = str_replace('"', '', $token);

        $key = "EstaEsUnaClaveSecretaMuySeguraParaTuTokenJWT123!";

        try {
            if (class_exists(Key::class)) {
                 try {
                    $decoded = JWT::decode($token, new Key($key, 'HS256'));
                 } catch (\Exception $e) {
                    $decoded = JWT::decode($token, new Key($key, 'HS512'));
                 }
            } else {
                $decoded = JWT::decode($token, $key, ['HS256', 'HS512']);
            }

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Error de Token: ' . $e->getMessage()
            ], 401);
        }

        return $next($request);
    }
}
