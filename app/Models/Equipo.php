<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
   // use HasFactory;
    protected $table = 'equipos';
    protected $fillable = [
        'cliente_id', 'tipo_equipo', 'marca', 'modelo', 
        'SKU', 'fecha', 'proximo_mantenimiento'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function mantenimientos()
    {
        return $table->hasMany(Mantenimiento::class, 'equipo_id');
    }
}
