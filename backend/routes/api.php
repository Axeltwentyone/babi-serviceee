<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AvisController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\PrestaireController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SignalementController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/prestataires', [PrestaireController::class, 'index']);
Route::get('/prestataires/{id}', [PrestaireController::class, 'show']);
Route::get('/categories', [CategorieController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id}', [ServiceController::class, 'show']);

// Routes authentifiées (client + admin)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Réservations (client)
    Route::apiResource('reservations', ReservationController::class);

    // Avis (client)
    Route::apiResource('avis', AvisController::class);

    // Signalements (client)
    Route::apiResource('signalements', SignalementController::class);

    // Routes admin uniquement
    Route::middleware('can:admin')->group(function () {
        Route::apiResource('admin/prestataires', PrestaireController::class)
            ->except(['index', 'show']);
        Route::apiResource('admin/categories', CategorieController::class)
            ->except(['index']);
        Route::apiResource('admin/services', ServiceController::class)
            ->except(['index', 'show']);
        Route::get('admin/users', [\App\Http\Controllers\Api\UserController::class, 'index']);
        Route::delete('admin/users/{id}', [\App\Http\Controllers\Api\UserController::class, 'destroy']);
    });
});
