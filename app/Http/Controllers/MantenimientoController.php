<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function store(Request $request, Equipo $equipo)
    {
        $request->validate([
            'descripcion_servicio' => 'required|string',
            'insumos_utilizados' => 'nullable|string',
            'fecha_servicio' => 'required|date',
            'costo' => 'nullable|numeric|min:0',
        ]);

        $equipo->mantenimientos()->create([
            'descripcion_servicio' => $request->descripcion_servicio,
            'insumos_utilizados' => $request->insumos_utilizados,
            'fecha_servicio' => $request->fecha_servicio,
            'estado' => 'completado',
            'costo' => $request->costo ?? 0,
        ]);

        return back()->with('mensaje', 'Historial técnico registrado correctamente.');
    }
}