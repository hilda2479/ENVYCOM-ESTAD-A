<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    //use HasFactory;
    protected $table = 'mantenimientos';

    protected $fillable = [
        'equipo_id', 'descripcion_servicio', 
        'insumos_utilizados', 'fecha_servicio', 'estado', 'costo'
    ];

    protected $casts = [
        'fecha_servicio' => 'date',
        'costo' => 'decimal:2',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
