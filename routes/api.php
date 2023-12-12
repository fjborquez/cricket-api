<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\SubpanelInsiderController;
use App\Http\Controllers\SubpanelResultadoAnualController;
use App\Http\Controllers\SubpanelSerieEstadisticaController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api'])->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::middleware(['api'])->get('/paneles', [PanelController::class, 'index']);
Route::middleware(['api'])->post('/paneles', [PanelController::class, 'store']);
Route::middleware(['api'])->get('/paneles/{panel}', [PanelController::class, 'show']);
Route::middleware(['api'])->delete('/paneles/{panel}', [PanelController::class, 'delete']);
Route::middleware(['api'])->put('/paneles/{panel}/series/{serie}', [PanelController::class, 'addSerie']);
Route::middleware(['api'])->delete('/paneles/{panel}/series/{serie}', [PanelController::class, 'removeSerie']);
Route::middleware(['api'])->put('/paneles/{panel}/insiders/{insider}', [PanelController::class, 'addInsider']);
Route::middleware(['api'])->delete('/paneles/{panel}/insiders/{insider}', [PanelController::class, 'removeInsider']);
Route::middleware(['api'])->put('/paneles/{panel}/resultados/{resultado}', [PanelController::class, 'addResultadoAnual']);
Route::middleware(['api'])->delete('/paneles/{panel}/resultados/{resultado}', [PanelController::class, 'removeResultadoAnual']);

Route::middleware(['api'])->get('/series-estadisticas', [SubpanelSerieEstadisticaController::class, 'index']);

Route::middleware(['api'])->get('/insiders', [SubpanelInsiderController::class, 'index']);

Route::middleware(['api'])->get('/resultados-anuales', [SubpanelResultadoAnualController::class, 'index']);
