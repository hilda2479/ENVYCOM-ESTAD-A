namespace App\Livewire;

use Livewire\Component;
use App\Models\Equipo;

class GestionarEquipos extends Component
{
    public $clienteId;
    public $tipo_equipo, $marca, $modelo, $SKU, $fecha, $proximo_mantenimiento;

    public function guardarEquipo()
    {
        $this->validate([
            'tipo_equipo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'SKU' => 'required|unique:equipos,SKU',
            'fecha' => 'required|date',
            'proximo_mantenimiento' => 'required|date',
        ]);

        Equipo::create([
            'cliente_id' => $this->clienteId,
            'tipo_equipo' => $this->tipo_equipo,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'SKU' => $this->SKU,
            'fecha' => $this->fecha,
            'proximo_mantenimiento' => $this->proximo_mantenimiento,
        ]);

        $this->reset(['tipo_equipo', 'marca', 'modelo', 'SKU', 'fecha', 'proximo_mantenimiento']);
        session()->flash('mensaje', 'Equipo vinculado correctamente.');
    }

    public function render()
    {
        $equipos = Equipo::where('cliente_id', $this->clienteId)->get();
        return view('livewire.gestionar-equipos', compact('equipos'));
    }
}