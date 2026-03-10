<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipo;

class GestionarEquipos extends Component
{
    public $clienteId;
    public $mostrarFormulario = false;

    public $tipo_equipo = '';
    public $marca = '';
    public $modelo = '';
    public $SKU = '';
    public $fecha = '';
    public $proximo_mantenimiento = '';

    protected $rules = [
        'tipo_equipo' => 'required|string|max:255',
        'marca' => 'required|string|max:255',
        'modelo' => 'required|string|max:255',
        'SKU' => 'required|string|max:255|unique:equipos,SKU',
        'fecha' => 'required|date',
        'proximo_mantenimiento' => 'required|date',
    ];

    protected $messages = [
        'tipo_equipo.required' => 'El tipo de equipo es obligatorio.',
        'marca.required' => 'La marca es obligatoria.',
        'modelo.required' => 'El modelo es obligatorio.',
        'SKU.required' => 'La serie / SKU es obligatoria.',
        'SKU.unique' => 'Ese SKU ya está registrado.',
        'fecha.required' => 'La fecha es obligatoria.',
        'proximo_mantenimiento.required' => 'La fecha de mantenimiento es obligatoria.',
    ];

    public function mount($clienteId)
    {
        $this->clienteId = $clienteId;
    }

    public function abrirFormulario()
    {
        $this->mostrarFormulario = true;
    }

    public function cerrarFormulario()
    {
        $this->mostrarFormulario = false;
        $this->limpiarFormulario();
        $this->resetValidation();
    }

    public function limpiarFormulario()
    {
        $this->tipo_equipo = '';
        $this->marca = '';
        $this->modelo = '';
        $this->SKU = '';
        $this->fecha = '';
        $this->proximo_mantenimiento = '';
    }

    public function guardar()
    {
        $this->validate();

        Equipo::create([
            'cliente_id' => $this->clienteId,
            'tipo_equipo' => $this->tipo_equipo,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'SKU' => $this->SKU,
            'fecha' => $this->fecha,
            'proximo_mantenimiento' => $this->proximo_mantenimiento,
        ]);

        session()->flash('mensaje', 'Equipo registrado correctamente.');

        $this->cerrarFormulario();
    }

    public function render()
    {
        $equipos = Equipo::where('cliente_id', $this->clienteId)
            ->with('cliente')
            ->get();

        return view('livewire.gestionar-equipos', compact('equipos'));
    }
}