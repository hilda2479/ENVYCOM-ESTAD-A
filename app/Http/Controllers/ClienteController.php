<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->get();
        return view('clientes.index', compact('clientes'));
    }

    // Muestra el formulario de edición
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // Procesa la actualización de los datos
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre_cliente' => 'required|min:3',
            'telefono'       => 'required|digits:10',
            'correo'         => 'required|email|unique:clientes,correo,' . $cliente->id,
            'sector'         => 'required',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')
                         ->with('mensaje', 'Cliente actualizado correctamente.');
    }

    // Elimina al cliente y sus equipos (por el onDelete cascade que pusimos en la migración)
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')
                         ->with('mensaje', 'Cliente eliminado del sistema.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }
}