<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlertaMantenimientoController;
use App\Http\Controllers\ReporteController;

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

    Route::get('/equipos/{equipo}/configurar-alerta', [AlertaMantenimientoController::class, 'form'])
        ->name('equipos.alerta.form');

    Route::post('/equipos/{equipo}/configurar-alerta', [AlertaMantenimientoController::class, 'configurar'])
        ->name('equipos.alerta.configurar');

    Route::post('/equipos/{equipo}/enviar-alerta', [AlertaMantenimientoController::class, 'enviarAhora'])
        ->name('equipos.alerta.enviar');

    Route::get('/reporte/{tipo}', [ReporteController::class, 'reportePeriodo'])->name('reportes.periodo');
});
