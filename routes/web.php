<?php

use App\Http\Controllers\CadClientesController;
use App\Http\Controllers\CadFreezersController;
use App\Http\Controllers\ContatosController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::prefix('/reports')->group(function () {
        Route::get('/freezer_info', [ReportsController::class, 'freezer_info'])->name('freezer_info');
    });

    Route::prefix('/clients')->group(function () {
        Route::get('/index', [CadClientesController::class, 'index'])->name('clients');
        Route::get('/create', [CadClientesController::class, 'create'])->name('clients.create');
        Route::post('/store', [CadClientesController::class, 'store'])->name('clients.store');
    });

    Route::prefix('/freezers')->group(function () {
    Route::get('/index', [CadFreezersController::class, 'index'])->name('freezers');
    Route::get('/create', [CadFreezersController::class, 'create'])->name('freezers.create');
    Route::post('/store', [CadFreezersController::class, 'store'])->name('freezers.store');
});

    Route::prefix('/contatos')->group(function () {
        Route::get('/index', [ContatosController::class, 'index'])->name('contatos');
    });
});

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

