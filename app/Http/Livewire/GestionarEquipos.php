<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Equipo;

class GestionarEquipos extends Component
{
    public $clienteId; 
    public $tipo_equipo, $marca, $modelo, $SKU, $proximo_mantenimiento;

    public function mount($clienteId)
    {
        $this->clienteId = $clienteId;
    }

    public function guardar()
    {
        $this->validate([
            'tipo_equipo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'SKU' => 'required|unique:equipos,SKU',
            'proximo_mantenimiento' => 'required|date',
        ]);

        Equipo::create([
            'cliente_id' => $this->clienteId,
            'tipo_equipo' => $this->tipo_equipo,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'SKU' => $this->SKU,
            'proximo_mantenimiento' => $this->proximo_mantenimiento,
        ]);

        $this->reset(['tipo_equipo', 'marca', 'modelo', 'SKU', 'proximo_mantenimiento']);
        session()->flash('mensaje', 'Equipo registrado exitosamente.');
    }

    public function render()
    {
        return view('livewire.gestionar-equipos', [
            'equipos' => Equipo::where('cliente_id', $this->clienteId)->get()
        ]);
    }
}