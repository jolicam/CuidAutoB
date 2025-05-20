<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\ServicioController;

// Ruta simple de prueba
Route::get('ping', function () {
    return response()->json(['pong' => true]);
});

// Rutas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('logout', [AuthController::class, 'logout']);

    // Usuarios
    Route::get('usuarios', [UsuarioController::class, 'index']);
    Route::post('usuarios', [UsuarioController::class, 'store']);
    Route::get('usuarios/{id}', [UsuarioController::class, 'show']);
    Route::put('usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('usuarios/{id}', [UsuarioController::class, 'destroy']);
    Route::post('usuarios/{id}/cambiar-contrasena', [UsuarioController::class, 'cambiarContrasena']);

    // Vehículos
    Route::get('vehiculos', [VehiculoController::class, 'index']);
    Route::post('vehiculos', [VehiculoController::class, 'store']);
    Route::get('vehiculos/{id}', [VehiculoController::class, 'show']);
    Route::put('vehiculos/{id}', [VehiculoController::class, 'update']);
    Route::delete('vehiculos/{id}', [VehiculoController::class, 'destroy']);

    // Alertas
    Route::get('alertas', [AlertaController::class, 'index']);
    Route::post('alertas', [AlertaController::class, 'store']);
    Route::get('alertas/{id}', [AlertaController::class, 'show']);
    Route::put('alertas/{id}', [AlertaController::class, 'update']);
    Route::delete('alertas/{id}', [AlertaController::class, 'destroy']);

    // Servicios
    Route::get('servicios', [ServicioController::class, 'index']);
    Route::post('servicios', [ServicioController::class, 'store']);
    Route::get('servicios/{id}', [ServicioController::class, 'show']);
    Route::put('servicios/{id}', [ServicioController::class, 'update']);
    Route::delete('servicios/{id}', [ServicioController::class, 'destroy']);
});

