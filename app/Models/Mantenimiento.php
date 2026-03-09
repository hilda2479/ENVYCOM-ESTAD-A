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
        'insumos_utilizados', 'fecha_servicio', 'estado'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id');
    }
}
