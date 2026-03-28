<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Sistema: Vicerrectorado Académico - UNASAM
 * Autor: Angel Rosales
 * Año: 2026
 *
 * Controlador para información del sistema y endpoints administrativos.
 * Solo accesible para usuarios con rol 'admin'.
 */
class SystemController extends Controller
{
    /**
     * Retorna información básica del sistema.
     *
     * Endpoint accesible solo para administradores.
     * Útil para verificar versión, autor y estado del sistema.
     *
     * @return JsonResponse JSON con datos del sistema
     */
    public function info(): JsonResponse
    {
        return response()->json([
            'system' => 'VRA UNASAM',
            'version' => '1.0.0',
            'author' => 'Angel Rosales',
            'timestamp' => now()->toIso8601String(),
        ]);
    }
}
