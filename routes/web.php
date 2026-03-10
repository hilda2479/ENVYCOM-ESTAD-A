<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EquipoController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        $totalClientes = Cliente::count();
        $totalEquipos = Equipo::count();
        $alertasMantenimiento = Equipo::whereDate('proximo_mantenimiento', '<=', Carbon::today()->addDays(7))->count();

        return view('dashboard', compact('totalClientes', 'totalEquipos', 'alertasMantenimiento'));
    })->name('dashboard');

    Route::resource('clientes', ClienteController::class);



Route::get('/equipos-registrados', [App\Http\Controllers\EquipoController::class, 'index'])->name('equipos.index');

});
