<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function reportePeriodo($tipo)
{
    $query = Equipo::with('cliente');
    $hoy = \Carbon\Carbon::today();

    if ($tipo == 'diario') {
        $query->whereDate('created_at', $hoy);
        $titulo = "Reporte Diario - " . $hoy->format('d/m/Y');
    } elseif ($tipo == 'semanal') {
        $query->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()]);
        $titulo = "Reporte Semanal";
    } elseif ($tipo == 'mensual') {
        $query->whereMonth('created_at', \Carbon\Carbon::now()->month);
        $titulo = "Reporte Mensual";
    } else {
        $titulo = "Inventario Completo";
    }

    $equipos = $query->get();
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.reporte_periodico', compact('equipos', 'titulo'));
    return $pdf->download('Reporte_ENVYCOM_' . $tipo . '.pdf');
}
}
