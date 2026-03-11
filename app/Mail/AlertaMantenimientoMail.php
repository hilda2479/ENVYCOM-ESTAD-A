<?php

namespace App\Mail;

use App\Models\Equipo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlertaMantenimientoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $equipo;
    public $tipoAlerta;
    public $diasRestantes;

    public function __construct(Equipo $equipo, string $tipoAlerta, int $diasRestantes)
    {
        $this->equipo = $equipo;
        $this->tipoAlerta = $tipoAlerta;
        $this->diasRestantes = $diasRestantes;
    }

    public function build()
    {
        $subject = match ($this->tipoAlerta) {
            'manual' => 'Alerta de mantenimiento - ' . $this->equipo->tipo_equipo,
            'vencido' => 'Mantenimiento vencido - ' . $this->equipo->tipo_equipo,
            default => 'Próximo mantenimiento - ' . $this->equipo->tipo_equipo,
        };

        return $this->subject($subject)
            ->view('emails.alerta-mantenimiento');
    }
}