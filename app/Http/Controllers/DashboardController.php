<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Equipo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalEquipos = Equipo::count();
        $alertasMantenimiento = Equipo::whereDate('proximo_mantenimiento', '<=', Carbon::today()->addDays(7))->count();

        $recibidos = Equipo::where('estatus', 'RECIBIDO')->count();
        $enProceso = Equipo::where('estatus', 'EN PROCESO')->count();
        $listos = Equipo::where('estatus', 'LISTO')->count();

        $equiposPrioritarios = Equipo::where('estatus', 'EN PROCESO')
            ->with('cliente')
            ->oldest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalClientes',
            'totalEquipos',
            'alertasMantenimiento',
            'recibidos',
            'enProceso',
            'listos',
            'equiposPrioritarios'
        ));
    }

    public function indicadores()
    {
        $hoy = Carbon::today();

        $equiposRecibidosMes = Equipo::whereMonth('created_at', $hoy->month)
            ->whereYear('created_at', $hoy->year)
            ->count();

        $equiposEntregados = Equipo::where('estatus', 'LISTO')->count();

        $mantenimientosVencidos = Equipo::whereDate('proximo_mantenimiento', '<', $hoy)
            ->where('estatus', '!=', 'LISTO')
            ->count();

        $marcasFrecuentes = Equipo::select('marca', DB::raw('COUNT(*) as total'))
            ->whereNotNull('marca')
            ->where('marca', '!=', '')
            ->groupBy('marca')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $fallasFrecuentes = collect();

        if (Schema::hasColumn('equipos', 'fallas_reportadas')) {
            $fallasFrecuentes = Equipo::select('fallas_reportadas', DB::raw('COUNT(*) as total'))
                ->whereNotNull('fallas_reportadas')
                ->where('fallas_reportadas', '!=', '')
                ->groupBy('fallas_reportadas')
                ->orderByDesc('total')
                ->limit(5)
                ->get();
        }

        $clientesConMasServicios = Cliente::withCount('equipos')
            ->orderByDesc('equipos_count')
            ->limit(5)
            ->get();

        $equiposPorMes = Equipo::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->whereYear('created_at', $hoy->year)
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $meses = collect(range(1, 12))->map(function ($mes) use ($equiposPorMes) {
            $registro = $equiposPorMes->firstWhere('mes', $mes);

            return [
                'mes' => $mes,
                'nombre' => Carbon::create()->month($mes)->locale('es')->translatedFormat('M'),
                'total' => $registro ? (int) $registro->total : 0,
            ];
        });

        $tiempoPromedioReparacion = null;

        if (
            Schema::hasColumn('equipos', 'fecha_recepcion') &&
            Schema::hasColumn('equipos', 'fecha_entrega')
        ) {
            $equiposConFechas = Equipo::whereNotNull('fecha_recepcion')
                ->whereNotNull('fecha_entrega')
                ->get();

            if ($equiposConFechas->count()) {
                $tiempoPromedioReparacion = round(
                    $equiposConFechas->avg(function ($equipo) {
                        return Carbon::parse($equipo->fecha_recepcion)
                            ->diffInDays(Carbon::parse($equipo->fecha_entrega));
                    }),
                    1
                );
            }
        }

        $maxMes = max(1, $meses->max('total'));
        $maxMarca = max(1, $marcasFrecuentes->max('total') ?? 1);
        $maxFalla = max(1, $fallasFrecuentes->max('total') ?? 1);
        $maxCliente = max(1, $clientesConMasServicios->max('equipos_count') ?? 1);

        return view('dashboard.indicadores', compact(
            'equiposRecibidosMes',
            'equiposEntregados',
            'mantenimientosVencidos',
            'tiempoPromedioReparacion',
            'marcasFrecuentes',
            'fallasFrecuentes',
            'clientesConMasServicios',
            'meses',
            'maxMes',
            'maxMarca',
            'maxFalla',
            'maxCliente'
        ));
    }
}