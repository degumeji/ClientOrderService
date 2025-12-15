<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;

use Illuminate\Http\Request;

Route::middleware(['jwt.auth'])->group(function () {

    // Rutas de Clientes [cite: 18-22]
    Route::apiResource('clients', ClientController::class);

    // Rutas de Pedidos [cite: 23-28]
    Route::apiResource('orders', OrderController::class);

    // Ruta extra para Dashboard [cite: 29]
    Route::get('/dashboard/stats', [OrderController::class, 'stats']);

    // Ruta temporal de diagnóstico
    Route::get('/check-token', function (Request $request) {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'No enviaste el token en Authorization: Bearer ...']);
        }

        try {
            // 1. Separar las partes del JWT
            $parts = explode('.', $token);
            if (count($parts) < 3) {
                return response()->json(['error' => 'El formato del token es incorrecto (no tiene 3 partes).']);
            }

            // 2. Decodificar el Header manualmente (sin librería)
            // Reemplazamos caracteres URL-safe por base64 estándar
            $headerJson = base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[0]));
            $header = json_decode($headerJson);

            return response()->json([
                'estado' => 'Token recibido',
                'algoritmo_real' => $header->alg, // <--- ¡ESTO ES LO QUE BUSCAMOS!
                'tipo' => $header->typ,
                'header_completo' => $header
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al leer: ' . $e->getMessage()]);
        }
    });
});
