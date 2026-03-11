<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'tipo_equipo',
        'marca',
        'modelo',
        'SKU',
        'proximo_mantenimiento',
        'estatus',

        // Campos de alertas
        'alerta_activa',
        'alerta_dias_antes',
        'dias_anticipacion_alerta',
        'alerta_un_dia_antes',
        'alerta_mismo_dia',
        'alerta_vencido',
        'ultima_alerta_enviada_at',
    ];

    protected $casts = [
        'proximo_mantenimiento' => 'date',
        'alerta_activa' => 'boolean',
        'alerta_dias_antes' => 'boolean',
        'alerta_un_dia_antes' => 'boolean',
        'alerta_mismo_dia' => 'boolean',
        'alerta_vencido' => 'boolean',
        'ultima_alerta_enviada_at' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}