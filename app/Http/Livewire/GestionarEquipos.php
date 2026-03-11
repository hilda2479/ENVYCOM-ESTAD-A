<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipo;

class GestionarEquipos extends Component
{

    public $estatus = 'RECIBIDO';

    public $clienteId;
    public $mostrarFormulario = false;

    public $tipo_equipo = '';
    public $marca = '';
    public $modelo = '';
    public $SKU = '';
    public $proximo_mantenimiento = '';

    protected $rules = [
        'tipo_equipo' => 'required|string|max:255',
        'marca' => 'required|string|max:255',
        'modelo' => 'required|string|max:255',
        'SKU' => 'required|string|max:255|unique:equipos,SKU',
        'proximo_mantenimiento' => 'required|date',
    ];

    protected $messages = [
        'tipo_equipo.required' => 'El tipo de equipo es obligatorio.',
        'marca.required' => 'La marca es obligatoria.',
        'modelo.required' => 'El modelo es obligatorio.',
        'SKU.required' => 'La serie / SKU es obligatoria.',
        'SKU.unique' => 'Ese SKU ya está registrado.',
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
        $this->proximo_mantenimiento = '';
    }

    public function guardar()
    {
        $this->validate([
            'tipo_equipo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'SKU' => 'required|unique:equipos,SKU',
            'proximo_mantenimiento' => 'required|date',
            'estatus' => 'required', // <--- Añade validación
        ]);

        Equipo::create([
            'cliente_id' => $this->clienteId,
            'tipo_equipo' => $this->tipo_equipo,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'SKU' => $this->SKU,
            'proximo_mantenimiento' => $this->proximo_mantenimiento,
            'estatus' => $this->estatus, // <--- Guarda el estatus
        ]);

        // Limpia el campo después de guardar
        $this->reset(['tipo_equipo', 'marca', 'modelo', 'SKU', 'proximo_mantenimiento', 'estatus']);
        $this->estatus = 'RECIBIDO'; // Reset al valor inicial
        session()->flash('mensaje', 'Equipo registrado exitosamente.');
    }

    public function render()
    {
        $equipos = Equipo::where('cliente_id', $this->clienteId)
            ->with('cliente')
            ->get();

        return view('livewire.gestionar-equipos', compact('equipos'));
    }

    public function actualizarEstatus($equipoId, $nuevoEstatus)
    {
        $equipo = Equipo::find($equipoId);

        if ($equipo) {
            $equipo->update([
                'estatus' => $nuevoEstatus
            ]);
            session()->flash('mensaje', 'Estatus de ' . $equipo->tipo_equipo . ' actualizado.');
        }
    }
}