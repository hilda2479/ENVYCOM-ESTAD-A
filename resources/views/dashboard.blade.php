<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 leading-tight uppercase italic">
            {{ __('ENVYCOM - Dashboard de Gestión') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Clientes Totales</h3>
                    <p class="text-3xl font-black text-gray-800">{{ $totalClientes }}</p>
                    <a href="{{ route('clientes.index') }}" class="text-[10px] text-blue-500 underline font-bold uppercase">Ver lista →</a>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-red-500">
                    <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Por Revisar</h3>
                    <p class="text-3xl font-black text-red-600">{{ $recibidos }}</p>
                    <p class="text-[10px] text-gray-400 italic">Nuevos ingresos</p>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-yellow-400">
                    <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest">En Reparación</h3>
                    <p class="text-3xl font-black text-yellow-600">{{ $enProceso }}</p>
                    <p class="text-[10px] text-gray-400 italic">Trabajando ahora</p>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-green-400">
                    <h3 class="text-[10px] font-black uppercase text-gray-500 tracking-widest">Listos p/ Entrega</h3>
                    <p class="text-3xl font-black text-green-600">{{ $listos }}</p>
                    <a href="{{ route('equipos.index') }}" class="text-[10px] text-green-400 underline font-bold uppercase">Ir al inventario →</a>
                </div>

            </div>

            @if($alertasMantenimiento > 0)
                <div class="mb-8 bg-red-50 border-l-4 border-red-600 p-4 flex justify-between items-center shadow-sm">
                    <div>
                        <h4 class="text-red-800 font-black text-xs uppercase italic">⚠️ Alerta de mantenimiento</h4>
                        <p class="text-red-600 text-[11px] font-bold uppercase">Tienes {{ $alertasMantenimiento }} equipos que requieren atención esta semana.</p>
                    </div>
                    <a href="{{ route('equipos.index') }}" class="bg-red-600 text-white text-[10px] px-4 py-2 rounded font-black uppercase hover:bg-black transition">Revisar</a>
                </div>
            @endif

            <div class="mt-8">
                <h3 class="font-black text-gray-800 uppercase italic mb-4 flex items-center">
                    <span class="bg-yellow-400 w-2 h-6 mr-2 shadow-sm"></span>
                    Prioridad: Equipos en reparación (Más antiguos)
                </h3>
                
                <div class="bg-white shadow-xl rounded-lg overflow-hidden border-t-4 border-yellow-400">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 uppercase text-[10px] font-black text-gray-500 italic">
                                <tr>
                                    <th class="px-6 py-4 text-left">Cliente</th>
                                    <th class="px-6 py-4 text-left">Equipo / Marca</th>
                                    <th class="px-6 py-4 text-left">Tiempo Transcurrido</th>
                                    <th class="px-6 py-4 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-[11px] uppercase">
                                @forelse($equiposPrioritarios as $prioridad)
                                    <tr class="hover:bg-yellow-50/50 transition-colors">
                                        <td class="px-6 py-4 font-black text-blue-600">
                                            {{ $prioridad->cliente->nombre_cliente }}
                                        </td>
                                        <td class="px-6 py-4 font-bold text-gray-700">
                                            {{ $prioridad->tipo_equipo }} 
                                            <span class="text-gray-400 font-normal">({{ $prioridad->marca }})</span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 font-mono">
                                            <span class="bg-gray-100 px-2 py-1 rounded text-gray-600 lowercase">
                                                ingresó {{ $prioridad->created_at->diffForHumans() }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('clientes.show', $prioridad->cliente_id) }}" 
                                               class="bg-gray-800 text-white px-4 py-2 rounded-lg text-[9px] font-black hover:bg-black transition shadow-sm uppercase">
                                                Gestionar →
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-black uppercase italic tracking-tighter">
                                            🎉 ¡Excelente! No tienes equipos pendientes de reparación.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>