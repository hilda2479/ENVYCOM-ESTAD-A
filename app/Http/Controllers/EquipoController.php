<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
public function index()
    {
        $equipos = \App\Models\Equipo::with('cliente')->get();
        return view('equipos.index', compact('equipos'));
    }
}
