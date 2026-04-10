<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Http\Requests\StoreEquipoRequest;


class EquipoController extends Controller
{
public function index()
    {
        $equipos = \App\Models\Equipo::with('cliente')->get();
        return view('equipos.index', compact('equipos'));
    }

    public function store(StoreEquipoRequest $request)
    {
        $equipo = Equipo::create($request->validated());
        
        return redirect()->route('equipos.index')->with('mensaje', 'Equipo guardado');
    }
}
