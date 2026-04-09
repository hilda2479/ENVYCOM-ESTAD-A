<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Models\Mantenimiento;
use App\Http\Requests\StoreMantenimientoRequest;

class MantenimientoController extends Controller
{
    public function store(StoreMantenimientoRequest $request, Equipo $equipo)
    {
        $equipo->mantenimientos()->create(array_merge(
            $request->validated(),
            ['estado' => 'completado']
        ));

        return back()->with('mensaje', 'Historial técnico registrado correctamente.');
    }
}