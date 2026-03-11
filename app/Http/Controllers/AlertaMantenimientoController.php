<?php

namespace App\Http\Controllers;

use App\Mail\AlertaMantenimientoMail;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AlertaMantenimientoController extends Controller
{
    public function configurar(Request $request, Equipo $equipo)
    {
        $request->validate([
            'alerta_activa' => ['nullable', 'boolean'],
            'alerta_dias_antes' => ['nullable', 'boolean'],
            'dias_anticipacion_alerta' => ['nullable', 'integer', 'min:1', 'max:365'],
            'alerta_un_dia_antes' => ['nullable', 'boolean'],
            'alerta_mismo_dia' => ['nullable', 'boolean'],
            'alerta_vencido' => ['nullable', 'boolean'],
        ]);

        $equipo->update([
            'alerta_activa' => $request->boolean('alerta_activa'),
            'alerta_dias_antes' => $request->boolean('alerta_dias_antes'),
            'dias_anticipacion_alerta' => $request->input('dias_anticipacion_alerta', 7),
            'alerta_un_dia_antes' => $request->boolean('alerta_un_dia_antes'),
            'alerta_mismo_dia' => $request->boolean('alerta_mismo_dia'),
            'alerta_vencido' => $request->boolean('alerta_vencido'),
        ]);

        return back()->with('mensaje', 'Alerta configurada correctamente.');
    }

    public function enviarAhora(Equipo $equipo)
    {
        if (!$equipo->cliente || empty($equipo->cliente->correo)) {
            return back()->with('mensaje', 'El cliente no tiene correo registrado.');
        }

        Mail::to($equipo->cliente->correo)
            ->send(new AlertaMantenimientoMail($equipo, 'manual', 0));

        $equipo->update([
            'ultima_alerta_enviada_at' => now(),
        ]);

        return back()->with('mensaje', 'Alerta enviada correctamente.');
    }
}