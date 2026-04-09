<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
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

    public function store(StoreClienteRequest $request)
    {
        Cliente::create($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente creado correctamente.');
    }
    
    public function archivos($id)
    {
        $cliente = \App\Models\Cliente::findOrFail($id);

        return view('clientes.archivos', compact('cliente'));
    }

    public function subirArchivo(Request $request, $id)
    {
        $cliente = \App\Models\Cliente::findOrFail($id);

        $request->validate([
            'archivo' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx|max:10240',
        ]);

        $archivo = $request->file('archivo');
        $ruta = $archivo->store('documentos_clientes', 'public');

        \App\Models\DocumentoCliente::create([
            'cliente_id' => $cliente->id,
            'nombre_original' => $archivo->getClientOriginalName(),
            'ruta' => $ruta,
            'extension' => $archivo->getClientOriginalExtension(),
            'mime_type' => $archivo->getMimeType(),
            'peso' => $archivo->getSize(),
        ]);

        return back()->with('mensaje', 'Archivo subido correctamente.');
    }
        
}