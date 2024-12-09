<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CadFreezersMastersController;
use App\Http\Controllers\Api\StatusSensorController;
use App\Http\Controllers\Api\TelemetriaEquipamentosController;
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

// Rota sem autenticação para leitura de temperatura
Route::get('/le_temperatura', [CadFreezersMastersController::class, 'le_temperatura']);
Route::get('/t_sensor_insere', [StatusSensorController::class, 't_sensor_insere']);
Route::get('/insert_temp_master', [StatusSensorController::class, 'insert_temp_master']);
Route::get('/insert_telemetria', [TelemetriaEquipamentosController::class, 'insert_telemetria']);
Route::get('/insert_temp', [StatusSensorController::class, 'insert_temp']);
