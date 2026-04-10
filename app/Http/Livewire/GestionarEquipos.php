<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Equipo;

class GestionarEquipos extends Component
{
    public $estatus = 'RECIBIDO';

    public $clienteId;
    public $mostrarFormulario = false;
    public $mostrarFormularioHistorial = [];

    public $tipo_equipo = '';
    public $marca = '';
    public $modelo = '';
    public $SKU = '';
    public $proximo_mantenimiento = '';

    public $fallas_reportadas = '';
    public $accesorios = '';
    public $diagnostico_inicial = '';
    public $observaciones = '';

    protected $rules = [
        'tipo_equipo' => 'required|string|max:30',
        'marca' => 'required|string|max:15',
        'modelo' => 'required|string|max:10',
        'SKU' => 'required|string|max:50|unique:equipos,SKU',
        'proximo_mantenimiento' => 'required|date',
        'estatus' => 'required|string|max:255',
    ];

    protected $messages = [
        'marca.max' => 'La marca no puede tener más de 15 caracteres.',
        'modelo.max' => 'El modelo es demasiado largo (máximo 10).',
        'tipo_equipo.max' => 'El tipo de equipo no debe exceder los 30 caracteres.',
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

    public function toggleFormularioHistorial($equipoId)
    {
        $this->mostrarFormularioHistorial[$equipoId] = !($this->mostrarFormularioHistorial[$equipoId] ?? false);
    }

    public function cerrarFormularioHistorial($equipoId)
    {
        $this->mostrarFormularioHistorial[$equipoId] = false;
    }

    public function limpiarFormulario()
    {
        $this->tipo_equipo = '';
        $this->marca = '';
        $this->modelo = '';
        $this->SKU = '';
        $this->proximo_mantenimiento = '';
        $this->estatus = 'RECIBIDO';

        $this->fallas_reportadas = '';
        $this->accesorios = '';
        $this->diagnostico_inicial = '';
        $this->observaciones = '';
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
            'proximo_mantenimiento' => $this->proximo_mantenimiento,
            'estatus' => $this->estatus,
            'fallas_reportadas' => $this->fallas_reportadas,
            'accesorios' => $this->accesorios,
            'diagnostico_inicial' => $this->diagnostico_inicial,
            'observaciones' => $this->observaciones,
        ]);

        $this->limpiarFormulario();
        $this->mostrarFormulario = false;

        session()->flash('mensaje', 'Equipo registrado y orden de servicio creada.');
    }

    public function render()
    {
        $equipos = Equipo::where('cliente_id', $this->clienteId)
            ->with(['cliente', 'mantenimientos'])
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