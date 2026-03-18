<?php

namespace App\Http\Controllers;

use App\Models\DocumentoCliente;
use Illuminate\Support\Facades\Storage;

class DocumentoClienteController extends Controller
{
    public function descargar(DocumentoCliente $documento)
    {
        if (!Storage::disk('public')->exists($documento->ruta)) {
            return back()->with('error', 'El archivo no existe o fue eliminado.');
        }

        return Storage::disk('public')->download(
            $documento->ruta,
            $documento->nombre_original
        );
    }

    public function eliminar(DocumentoCliente $documento)
    {
        if (Storage::disk('public')->exists($documento->ruta)) {
            Storage::disk('public')->delete($documento->ruta);
        }

        $documento->delete();

        return back()->with('mensaje', 'Archivo eliminado correctamente.');
    }
}