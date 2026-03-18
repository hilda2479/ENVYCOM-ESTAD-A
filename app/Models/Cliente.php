<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_cliente', 
        'telefono', 
        'correo', 
        'sector'
    ];

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'cliente_id');
    }

    public function documentos()
    {
        return $this->hasMany(DocumentoCliente::class);
    }
}