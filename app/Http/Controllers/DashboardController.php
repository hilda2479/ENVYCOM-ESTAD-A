<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Equipo;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $totalClientes = Cliente::count();
    $totalEquipos = Equipo::count();
    $alertasMantenimiento = Equipo::whereDate('proximo_mantenimiento', '<=', Carbon::today()->addDays(7))->count();

    $recibidos = Equipo::where('estatus', 'RECIBIDO')->count();
    $enProceso = Equipo::where('estatus', 'EN PROCESO')->count();
    $listos = Equipo::where('estatus', 'LISTO')->count();
    $equiposPrioritarios = Equipo::where('estatus', 'EN PROCESO')
        ->with('cliente')
        ->oldest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalClientes', 
        'totalEquipos', 
        'alertasMantenimiento', 
        'recibidos', 
        'enProceso', 
        'listos',
        'equiposPrioritarios'
    ));
}
}