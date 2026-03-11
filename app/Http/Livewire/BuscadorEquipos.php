<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipo;

class BuscadorEquipos extends Component
{
    public $search = '';

    public $mostrarModalAlerta = false;
    public $equipoSeleccionado = null;

    public function abrirModalAlerta($equipoId)
    {
        $this->equipoSeleccionado = Equipo::with('cliente')->find($equipoId);
        $this->mostrarModalAlerta = true;
    }

    public function cerrarModalAlerta()
    {
        $this->mostrarModalAlerta = false;
        $this->equipoSeleccionado = null;
    }

    public function render()
    {
        $equipos = Equipo::query()
            ->with('cliente')
            ->where(function ($query) {
                $query->where('SKU', 'like', '%' . $this->search . '%')
                    ->orWhere('marca', 'like', '%' . $this->search . '%')
                    ->orWhere('tipo_equipo', 'like', '%' . $this->search . '%')
                    ->orWhereHas('cliente', function ($subQuery) {
                        $subQuery->where('nombre_cliente', 'like', '%' . $this->search . '%');
                    });
            })
            ->get();

        return view('livewire.buscador-equipos', compact('equipos'));
    }

    public function actualizarEstatus($equipoId, $nuevoEstatus)
    {
        $equipo = Equipo::find($equipoId);

        if ($equipo) {
            $equipo->update([
                'estatus' => $nuevoEstatus
            ]);
        }
    }
}