<?php

namespace App\Console\Commands;

use App\Mail\AlertaMantenimientoMail;
use App\Models\Equipo;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarAlertasMantenimiento extends Command
{
    protected $signature = 'mantenimiento:alertas';
    protected $description = 'Envía alertas automáticas de mantenimiento';

    public function handle(): int
    {
        $hoy = Carbon::today();

        $equipos = Equipo::with('cliente')
            ->where('alerta_activa', true)
            ->get();

        foreach ($equipos as $equipo) {
            if (!$equipo->cliente || empty($equipo->cliente->correo) || empty($equipo->proximo_mantenimiento)) {
                continue;
            }

            $fechaMantenimiento = Carbon::parse($equipo->proximo_mantenimiento);
            $diasRestantes = $hoy->diffInDays($fechaMantenimiento, false);

            $enviar = false;
            $tipoAlerta = 'proximo';

            if ($equipo->alerta_dias_antes && $diasRestantes == $equipo->dias_anticipacion_alerta) {
                $enviar = true;
            }

            if ($equipo->alerta_un_dia_antes && $diasRestantes == 1) {
                $enviar = true;
            }

            if ($equipo->alerta_mismo_dia && $diasRestantes == 0) {
                $enviar = true;
            }

            if ($equipo->alerta_vencido && $diasRestantes < 0) {
                $enviar = true;
                $tipoAlerta = 'vencido';
            }

            if (!$enviar) {
                continue;
            }

            $yaSeEnvioHoy = $equipo->ultima_alerta_enviada_at &&
                Carbon::parse($equipo->ultima_alerta_enviada_at)->isSameDay($hoy);

            if ($yaSeEnvioHoy) {
                continue;
            }

            Mail::to($equipo->cliente->correo)
                ->send(new AlertaMantenimientoMail($equipo, $tipoAlerta, max($diasRestantes, 0)));

            $equipo->update([
                'ultima_alerta_enviada_at' => now(),
            ]);
        }

        return self::SUCCESS;
    }
}