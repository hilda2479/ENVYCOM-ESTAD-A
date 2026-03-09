<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;

class AdministrarClientes extends Component
{
    public $nombre_cliente;
    public $telefono;
    public $correo;
    public $sector;

    protected $rules = [
        'nombre_cliente' => 'required|string|max:255',
        'telefono' => 'required|string|max:20',
        'correo' => 'required|email|max:255',
        'sector' => 'required|string|max:50',
    ];

    // Crear cliente
    public function guardarCliente()
    {
        $this->validate();

        Cliente::create([
            'nombre_cliente' => $this->nombre_cliente,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'sector' => $this->sector,
        ]);

        $this->reset(['nombre_cliente','telefono','correo','sector']);
        session()->flash('mensaje', 'Cliente creado correctamente');
    }

    public function eliminarCliente($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente) {
            $cliente->delete();
            session()->flash('mensaje', 'Cliente eliminado correctamente');
        }
    }

    public function render()
    {
        return view('clientes.create', [
            'clientes' => Cliente::all(),
        ]);
    }
}