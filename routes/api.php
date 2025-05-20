<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\AlertaController;
use App\Http\Controllers\AuthController;

// Rutas públicas (registro y login)
Route::post('/registro', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con autenticación Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Usuarios - CRUD y cambio de contraseña
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
    Route::put('/usuarios/{id}/cambiar-contrasena', [UsuarioController::class, 'cambiarContrasena']);

    // Vehículos - CRUD completo
    Route::get('/vehiculos', [VehiculoController::class, 'index']);
    Route::post('/vehiculos', [VehiculoController::class, 'store']);
    Route::get('/vehiculos/{id}', [VehiculoController::class, 'show']);
    Route::put('/vehiculos/{id}', [VehiculoController::class, 'update']);
    Route::delete('/vehiculos/{id}', [VehiculoController::class, 'destroy']);

    // Servicios - CRUD completo
    Route::get('/servicios', [ServicioController::class, 'index']);
    Route::post('/servicios', [ServicioController::class, 'store']);
    Route::get('/servicios/{id}', [ServicioController::class, 'show']);
    Route::put('/servicios/{id}', [ServicioController::class, 'update']);
    Route::delete('/servicios/{id}', [ServicioController::class, 'destroy']);

    // Alertas - CRUD completo
    Route::get('/alertas', [AlertaController::class, 'index']);
    Route::post('/alertas', [AlertaController::class, 'store']);
    Route::get('/alertas/{id}', [AlertaController::class, 'show']);
    Route::put('/alertas/{id}', [AlertaController::class, 'update']);
    Route::delete('/alertas/{id}', [AlertaController::class, 'destroy']);
});
