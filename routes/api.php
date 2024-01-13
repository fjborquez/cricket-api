<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\SubpanelController;
use App\Http\Controllers\SubpanelInsiderController;
use App\Http\Controllers\SubpanelResultadoAnualController;
use App\Http\Controllers\SubpanelSerieEstadisticaController;
use App\Http\Controllers\UserController;
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
Route::middleware(['api'])->put('/paneles/{panel}/subpaneles/{serie}', [PanelController::class, 'addSubpanel']);
Route::middleware(['api'])->delete('/paneles/{panel}/subpaneles/{serie}', [PanelController::class, 'removeSubpanel']);

Route::middleware(['api'])->get('/subpaneles', [SubpanelController::class, 'index']);
Route::middleware(['api'])->post('/subpaneles', [SubpanelController::class, 'create']);
Route::middleware(['api'])->delete('/subpaneles/{id}', [SubpanelController::class, 'delete']);

Route::middleware(['api'])->get('/users', [UserController::class, 'index']);
Route::middleware(['api'])->post('/users', [UserController::class, 'create']);
