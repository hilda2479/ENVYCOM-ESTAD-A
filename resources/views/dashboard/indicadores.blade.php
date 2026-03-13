<x-app-layout>
    <style>
        :root{
            --envy-lime: #DFFF00;
            --envy-dark: #1E2A3B;
            --envy-soft: #f5f7fa;
            --envy-gray: #6b7280;
            --envy-border: #e5e7eb;
            --envy-red: #dc2626;
            --envy-yellow: #d97706;
            --envy-green: #15803d;
            --envy-blue-soft: #e8eef8;
        }

        .dashboard-shell{
            background:
                radial-gradient(circle at top right, rgba(223,255,0,.12), transparent 18%),
                linear-gradient(180deg, #f8fafc 0%, #f3f6fa 100%);
            min-height: calc(100vh - 64px);
        }

        .dashboard-wrapper{
            max-width: 1350px;
            margin: 0 auto;
            padding: 32px 20px 48px;
        }

        .dashboard-topbar{
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }

        .dashboard-title{
            font-size: 2rem;
            font-weight: 900;
            text-transform: uppercase;
            color: var(--envy-dark);
            letter-spacing: -.5px;
            margin-bottom: 6px;
            line-height: 1.05;
        }

        .dashboard-subtitle{
            color: var(--envy-gray);
            font-weight: 600;
            max-width: 760px;
        }

        .back-btn{
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1px solid var(--envy-border);
            color: var(--envy-dark);
            padding: 12px 16px;
            border-radius: 14px;
            font-size: .78rem;
            font-weight: 900;
            text-transform: uppercase;
            box-shadow: 0 8px 24px rgba(0,0,0,.05);
            transition: .2s ease;
            text-decoration: none;
        }

        .back-btn:hover{
            transform: translateY(-1px);
            color: #111827;
            box-shadow: 0 10px 26px rgba(0,0,0,.08);
        }

        .grid{
            display: grid;
            gap: 22px;
        }

        .grid-kpis{
            grid-template-columns: repeat(4, minmax(0, 1fr));
            margin-bottom: 22px;
        }

        .grid-2{
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-bottom: 22px;
        }

        .card,
        .kpi-card{
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(229,231,235,.9);
            border-radius: 22px;
            box-shadow: 0 16px 40px rgba(30,42,59,.06);
        }

        .kpi-card{
            padding: 22px;
            position: relative;
            overflow: hidden;
        }

        .kpi-card::before{
            content: '';
            position: absolute;
            inset: 0 auto auto 0;
            width: 100%;
            height: 6px;
            background: var(--envy-lime);
        }

        .kpi-label{
            font-size: .76rem;
            text-transform: uppercase;
            font-weight: 900;
            color: var(--envy-gray);
            margin-bottom: 12px;
            letter-spacing: .7px;
        }

        .kpi-value{
            font-size: 2rem;
            font-weight: 900;
            color: var(--envy-dark);
            line-height: 1;
            margin-bottom: 10px;
        }

        .kpi-note{
            font-size: .88rem;
            color: var(--envy-gray);
            font-weight: 600;
            line-height: 1.45;
        }

        .card{
            padding: 22px;
            height: 100%;
        }

        .section-title{
            font-size: .92rem;
            text-transform: uppercase;
            font-weight: 900;
            color: var(--envy-dark);
            letter-spacing: .5px;
            margin-bottom: 16px;
        }

        .section-head{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .mini-badge{
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: .68rem;
            text-transform: uppercase;
            font-weight: 900;
            background: var(--envy-blue-soft);
            color: var(--envy-dark);
        }

        .bar-list{
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .bar-item{
            display: grid;
            grid-template-columns: 160px 1fr 56px;
            gap: 12px;
            align-items: center;
        }

        .bar-label{
            font-size: .82rem;
            font-weight: 800;
            color: #374151;
            text-transform: uppercase;
            word-break: break-word;
        }

        .bar-track{
            width: 100%;
            height: 14px;
            background: #eef2f7;
            border-radius: 999px;
            overflow: hidden;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.04);
        }

        .bar-fill{
            height: 100%;
            background: linear-gradient(90deg, var(--envy-lime), #c7ec00);
            border-radius: 999px;
        }

        .bar-fill-dark{
            background: linear-gradient(90deg, #1E2A3B, #334761);
        }

        .bar-fill-red{
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }

        .bar-fill-yellow{
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }

        .bar-value{
            font-size: .8rem;
            font-weight: 900;
            color: var(--envy-dark);
            text-align: right;
        }

        .table-envy{
            width: 100%;
            border-collapse: collapse;
        }

        .table-envy thead th{
            font-size: .72rem;
            text-transform: uppercase;
            color: var(--envy-gray);
            font-weight: 900;
            border-bottom: 1px solid var(--envy-border);
            padding: 12px 10px;
            text-align: left;
            letter-spacing: .4px;
        }

        .table-envy tbody td{
            padding: 13px 10px;
            border-bottom: 1px solid #f0f2f5;
            font-size: .88rem;
            color: #374151;
            font-weight: 700;
        }

        .table-envy tbody tr:last-child td{
            border-bottom: none;
        }

        .pill{
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: .72rem;
            text-transform: uppercase;
            font-weight: 900;
        }

        .pill-danger{
            background: #fee2e2;
            color: #b91c1c;
        }

        .pill-success{
            background: #dcfce7;
            color: #166534;
        }

        .pill-warning{
            background: #fef3c7;
            color: #92400e;
        }

        .empty-state{
            padding: 30px;
            text-align: center;
            color: var(--envy-gray);
            font-weight: 700;
            background: #fafafa;
            border: 1px dashed #d1d5db;
            border-radius: 16px;
            line-height: 1.6;
        }

        .summary-list{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .summary-item{
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #eef2f7;
        }

        .summary-item:last-child{
            border-bottom: none;
        }

        .summary-label{
            font-size: .78rem;
            text-transform: uppercase;
            font-weight: 900;
            color: var(--envy-gray);
            letter-spacing: .4px;
        }

        .highlight-box{
            margin-top: 18px;
            border: 1px solid #e4ebf3;
            background: #f8fbff;
            border-radius: 16px;
            padding: 16px;
        }

        .highlight-title{
            font-size: .78rem;
            font-weight: 900;
            text-transform: uppercase;
            color: var(--envy-dark);
            margin-bottom: 10px;
        }

        .highlight-text{
            font-size: .9rem;
            color: #4b5563;
            line-height: 1.55;
            font-weight: 600;
        }

        @media (max-width: 1200px){
            .grid-kpis{
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 991px){
            .grid-2{
                grid-template-columns: 1fr;
            }

            .bar-item{
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .bar-value{
                text-align: left;
            }
        }

        @media (max-width: 640px){
            .dashboard-wrapper{
                padding: 24px 14px 40px;
            }

            .dashboard-title{
                font-size: 1.55rem;
            }

            .grid-kpis{
                grid-template-columns: 1fr;
            }

            .kpi-value{
                font-size: 1.7rem;
            }
        }
    </style>

    <div class="dashboard-shell">
        <div class="dashboard-wrapper">
            <div class="dashboard-topbar">
                <div>
                    <h1 class="dashboard-title">Panel de indicadores</h1>
                    <p class="dashboard-subtitle">
                        Visualiza métricas clave del servicio técnico y mantenimiento en ENVYCOM. Esta vista resume la operación actual, ayuda a detectar prioridades y facilita la toma de decisiones.
                    </p>
                </div>

                <a href="{{ route('dashboard') }}" class="back-btn">
                    <span>←</span>
                    <span>Volver al dashboard</span>
                </a>
            </div>

            <div class="grid grid-kpis">
                <div class="kpi-card">
                    <div class="kpi-label">Equipos recibidos este mes</div>
                    <div class="kpi-value">{{ $equiposRecibidosMes ?? 0 }}</div>
                    <div class="kpi-note">Ingresos registrados durante el mes actual.</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-label">Equipos entregados</div>
                    <div class="kpi-value">{{ $equiposEntregados ?? 0 }}</div>
                    <div class="kpi-note">Equipos que ya concluyeron satisfactoriamente el proceso.</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-label">Mantenimientos vencidos</div>
                    <div class="kpi-value">{{ $mantenimientosVencidos ?? 0 }}</div>
                    <div class="kpi-note">Equipos con fecha vencida y aún pendientes de atención.</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-label">Tiempo promedio de reparación</div>
                    <div class="kpi-value">
                        {{ $tiempoPromedioReparacion !== null ? $tiempoPromedioReparacion . ' días' : 'N/D' }}
                    </div>
                    <div class="kpi-note">Promedio calculado entre recepción y entrega del equipo.</div>
                </div>
            </div>

            <div class="grid grid-2">
                <div class="card">
                    <div class="section-head">
                        <h2 class="section-title">Equipos recibidos por mes</h2>
                        <span class="mini-badge">Vista anual</span>
                    </div>

                    <div class="bar-list">
                        @foreach($meses as $mes)
                            <div class="bar-item">
                                <div class="bar-label">{{ $mes['nombre'] }}</div>
                                <div class="bar-track">
                                    <div class="bar-fill"
                                        style="width: {{ $maxMes > 0 ? ($mes['total'] / $maxMes) * 100 : 0 }}%;">
                                    </div>
                                </div>
                                <div class="bar-value">{{ $mes['total'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="section-head">
                        <h2 class="section-title">Marcas más frecuentes</h2>
                        <span class="mini-badge">Top 5</span>
                    </div>

                    @if(isset($marcasFrecuentes) && $marcasFrecuentes->count())
                        <div class="bar-list">
                            @foreach($marcasFrecuentes as $marca)
                                <div class="bar-item">
                                    <div class="bar-label">{{ $marca->marca ?: 'Sin marca' }}</div>
                                    <div class="bar-track">
                                        <div class="bar-fill bar-fill-dark"
                                            style="width: {{ $maxMarca > 0 ? ($marca->total / $maxMarca) * 100 : 0 }}%;">
                                        </div>
                                    </div>
                                    <div class="bar-value">{{ $marca->total }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            No hay marcas registradas todavía.
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-2">
                <div class="card">
                    <div class="section-head">
                        <h2 class="section-title">Fallas más comunes</h2>
                        <span class="mini-badge">Incidencias</span>
                    </div>

                    @if(isset($fallasFrecuentes) && $fallasFrecuentes->count())
                        <div class="bar-list">
                            @foreach($fallasFrecuentes as $falla)
                                <div class="bar-item">
                                    <div class="bar-label">{{ $falla->fallas_reportadas }}</div>
                                    <div class="bar-track">
                                        <div class="bar-fill bar-fill-red"
                                            style="width: {{ $maxFalla > 0 ? ($falla->total / $maxFalla) * 100 : 0 }}%;">
                                        </div>
                                    </div>
                                    <div class="bar-value">{{ $falla->total }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            No hay suficientes fallas registradas para generar este indicador.
                        </div>
                    @endif
                </div>

                <div class="card">
                    <div class="section-head">
                        <h2 class="section-title">Clientes con más servicios</h2>
                        <span class="mini-badge">Top clientes</span>
                    </div>

                    @if(isset($clientesConMasServicios) && $clientesConMasServicios->count())
                        <div class="bar-list">
                            @foreach($clientesConMasServicios as $cliente)
                                <div class="bar-item">
                                    <div class="bar-label">{{ $cliente->nombre_cliente }}</div>
                                    <div class="bar-track">
                                        <div class="bar-fill bar-fill-yellow"
                                            style="width: {{ $maxCliente > 0 ? ($cliente->equipos_count / $maxCliente) * 100 : 0 }}%;">
                                        </div>
                                    </div>
                                    <div class="bar-value">{{ $cliente->equipos_count }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            No hay clientes suficientes para mostrar ranking.
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-2">
                <div class="card">
                    <div class="section-head">
                        <h2 class="section-title">Top marcas más registradas</h2>
                        <span class="mini-badge">Resumen</span>
                    </div>

                    @if(isset($marcasFrecuentes) && $marcasFrecuentes->count())
                        <div class="overflow-x-auto">
                            <table class="table-envy">
                                <thead>
                                    <tr>
                                        <th>Marca</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($marcasFrecuentes as $marca)
                                        <tr>
                                            <td>{{ $marca->marca ?: 'Sin marca' }}</td>
                                            <td>{{ $marca->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            No hay marcas registradas todavía.
                        </div>
                    @endif
                </div>

                <div class="card">
                    <div class="section-head">
                        <h2 class="section-title">Resumen operativo</h2>
                        <span class="mini-badge">Actual</span>
                    </div>

                    <div class="summary-list">
                        <div class="summary-item">
                            <span class="summary-label">Equipos recibidos este mes</span>
                            <span class="pill pill-success">{{ $equiposRecibidosMes ?? 0 }}</span>
                        </div>

                        <div class="summary-item">
                            <span class="summary-label">Equipos entregados</span>
                            <span class="pill pill-success">{{ $equiposEntregados ?? 0 }}</span>
                        </div>

                        <div class="summary-item">
                            <span class="summary-label">Mantenimientos vencidos</span>
                            <span class="pill pill-danger">{{ $mantenimientosVencidos ?? 0 }}</span>
                        </div>

                        <div class="summary-item">
                            <span class="summary-label">Tiempo promedio de reparación</span>
                            <span class="pill pill-warning">
                                {{ $tiempoPromedioReparacion !== null ? $tiempoPromedioReparacion . ' días' : 'N/D' }}
                            </span>
                        </div>
                    </div>

                    <div class="highlight-box">
                        <div class="highlight-title">Interpretación rápida</div>
                        <div class="highlight-text">
                            Este panel permite identificar carga operativa, tendencia de ingreso de equipos, marcas con mayor frecuencia,
                            posibles focos de falla y clientes con más recurrencia de servicio. Es útil para priorizar actividades,
                            planear mantenimientos y respaldar decisiones de operación.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>