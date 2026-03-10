<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clientes', ClienteController::class);



    Route::get('/equipos-registrados', [EquipoController::class, 'index'])->name('equipos.index');
});
