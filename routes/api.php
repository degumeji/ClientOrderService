<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;

use Illuminate\Http\Request;

Route::middleware(['jwt.auth'])->group(function () {

    Route::apiResource('clients', ClientController::class);

    Route::apiResource('orders', OrderController::class);

    Route::get('/dashboard/stats', [OrderController::class, 'stats']);

    Route::get('/check-token', function (Request $request) {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'No enviaste el token en Authorization: Bearer ...']);
        }

        try {

            $parts = explode('.', $token);
            if (count($parts) < 3) {
                return response()->json(['error' => 'El formato del token es incorrecto (no tiene 3 partes).']);
            }

            $headerJson = base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[0]));
            $header = json_decode($headerJson);

            return response()->json([
                'estado' => 'Token recibido',
                'algoritmo_real' => $header->alg,
                'tipo' => $header->typ,
                'header_completo' => $header
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al leer: ' . $e->getMessage()]);
        }
    });
});
