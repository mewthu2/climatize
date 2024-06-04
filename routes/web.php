<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\FreezersController;
use App\Http\Controllers\ContatosController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\EquipamentosController;
use App\Http\Controllers\SensoresController;
use App\Http\Controllers\PanelTemperaturasController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix('/reports')->group(function () {
        Route::get('/freezer_info', [ReportsController::class, 'freezer_info'])->name('freezer_info');
    });

    Route::prefix('/usuarios')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/{id}/update', [UsersController::class, 'update'])->name('users.update');
        Route::get('/{id}/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
    }); 

    Route::prefix('/clientes')->group(function () {
        Route::get('/', [ClientesController::class, 'index'])->name('clients');
        Route::get('/create', [ClientesController::class, 'create'])->name('clients.create');
        Route::post('/store', [ClientesController::class, 'store'])->name('clients.store');
        Route::get('/{id}/edit', [ClientesController::class, 'edit'])->name('clients.edit');
        Route::put('/{id}/update', [ClientesController::class, 'update'])->name('clients.update');
        Route::get('/{id}/destroy', [ClientesController::class, 'destroy'])->name('clients.destroy');
    });

    Route::prefix('/freezers')->group(function () {
        Route::get('/', [FreezersController::class, 'index'])->name('freezers');
        Route::get('/create', [FreezersController::class, 'create'])->name('freezers.create');
        Route::post('/store', [FreezersController::class, 'store'])->name('freezers.store');
        Route::get('/{id}/edit', [FreezersController::class, 'edit'])->name('freezers.edit');
        Route::put('/{id}/update', [FreezersController::class, 'update'])->name('freezers.update');
        Route::get('/{id}/destroy', [FreezersController::class, 'destroy'])->name('freezers.destroy');
    });

    Route::prefix('/equipamentos')->group(function () {
        Route::get('/', [EquipamentosController::class, 'index'])->name('equipments');
        Route::get('/create', [EquipamentosController::class, 'create'])->name('equipments.create');
        Route::post('/store', [EquipamentosController::class, 'store'])->name('equipments.store');
        Route::get('/{id}/edit', [EquipamentosController::class, 'edit'])->name('equipments.edit');
        Route::put('/{id}/update', [EquipamentosController::class, 'update'])->name('equipments.update');
        Route::get('/{id}/destroy', [EquipamentosController::class, 'destroy'])->name('equipments.destroy');
    });
    
    Route::prefix('/sensores')->group(function () {
        Route::get('/', [SensoresController::class, 'index'])->name('sensors');
        Route::get('/create', [SensoresController::class, 'create'])->name('sensors.create');
        Route::post('/store', [SensoresController::class, 'store'])->name('sensors.store');
        Route::get('/{id}/edit', [SensoresController::class, 'edit'])->name('sensors.edit');
        Route::put('/{id}/update', [SensoresController::class, 'update'])->name('sensors.update');
        Route::get('/{id}/destroy', [SensoresController::class, 'destroy'])->name('sensors.destroy');
    });

    Route::prefix('/painel_temperaturas')->group(function () {
        Route::get('/', [PanelTemperaturasController::class, 'index'])->name('painel_temperaturas');
        Route::get('/create', [PanelTemperaturasController::class, 'create'])->name('painel_temperaturas.create');
        Route::post('/store', [PanelTemperaturasController::class, 'store'])->name('painel_temperaturas.store');
        Route::get('/{id}/edit', [PanelTemperaturasController::class, 'edit'])->name('painel_temperaturas.edit');
        Route::put('/{id}/update', [PanelTemperaturasController::class, 'update'])->name('painel_temperaturas.update');
        Route::get('/{id}/destroy', [PanelTemperaturasController::class, 'destroy'])->name('painel_temperaturas.destroy');
    }); 

    Route::prefix('/contatos')->group(function () {
        Route::get('/', [ContatosController::class, 'index'])->name('contatos');
    });
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

