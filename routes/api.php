<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaloriaController;
use App\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/crear-usuario', [PersonaController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/personas/{id}', [PersonaController::class, 'get']);
Route::put('/personas/{id}', [PersonaController::class, 'update']);

Route::middleware('auth')->group(function () {
    Route::post('/calorias', [CaloriaController::class, 'store']);

    Route::get('/calorias/historico/{personaId}', [CaloriaController::class, 'historico']);
    Route::get('/calorias/historico/{personaId}', [CaloriaController::class, 'historicoUsuario']);
});