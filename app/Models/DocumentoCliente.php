<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoCliente extends Model
{
    use HasFactory;

    protected $table = 'documentos_clientes';

    protected $fillable = [
        'cliente_id',
        'nombre_original',
        'ruta',
        'extension',
        'mime_type',
        'peso',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}