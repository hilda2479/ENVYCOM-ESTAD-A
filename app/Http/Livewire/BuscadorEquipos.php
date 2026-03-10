<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipo;

class BuscadorEquipos extends Component
{
    public $search = '';

    public function render()
    {
        $equipos = Equipo::query()
            ->with('cliente')
            ->where('SKU', 'like', '%' . $this->search . '%')
            ->orWhere('marca', 'like', '%' . $this->search . '%')
            ->orWhere('tipo_equipo', 'like', '%' . $this->search . '%')
            ->orWhereHas('cliente', function ($query) {
                $query->where('nombre_cliente', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.buscador-equipos', compact('equipos'));
    }

    public function actualizarEstatus($equipoId, $nuevoEstatus)
    {
        $equipo = \App\Models\Equipo::find($equipoId);
        if ($equipo) {
            $equipo->update(['estatus' => $nuevoEstatus]);
        }
    }
}
