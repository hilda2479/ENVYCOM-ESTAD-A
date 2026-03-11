<div>
    <div class="mb-6">
        <div class="relative">
            <input wire:model.live="search" type="text"
                placeholder="BUSCAR EQUIPO, SKU O CLIENTE..."
                class="w-full pl-10 pr-4 py-3 border-2 border-[#4A4A4A] rounded-lg text-xs font-black uppercase focus:ring-[#DFFF00] focus:border-[#DFFF00] transition shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-xl rounded-lg overflow-hidden border-t-8 border-[#DFFF00]">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 uppercase text-[10px] font-black text-gray-500 tracking-widest">
                <tr>
                    <th class="px-6 py-4 text-left">Propietario</th>
                    <th class="px-6 py-4 text-left">Equipo</th>
                    <th class="px-6 py-4 text-left">Serie / SKU</th>
                    <th class="px-6 py-4 text-left">Estado</th>
                    <th class="px-6 py-4 text-left">Mantenimiento</th>
                    <th class="px-6 py-4 text-left">Alerta</th>
                    <th class="px-6 py-4 text-right">Acción</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 uppercase text-xs">
                @forelse($equipos as $equipo)
                    <tr class="hover:bg-gray-50 transition-colors" wire:key="global-{{ $equipo->id }}">
                        <td class="px-6 py-4 font-black text-blue-600">
                            {{ $equipo->cliente->nombre_cliente }}
                        </td>

                        <td class="px-6 py-4 font-bold text-gray-800">
                            {{ $equipo->tipo_equipo }}
                            <span class="text-gray-400 font-normal">({{ $equipo->marca }})</span>
                        </td>

                        <td class="px-6 py-4 font-mono text-gray-600">
                            {{ $equipo->SKU }}
                        </td>

                        <td class="px-6 py-4">
                            <select
                                wire:change="actualizarEstatus({{ $equipo->id }}, $event.target.value)"
                                class="text-[9px] font-black uppercase rounded-full border px-2 py-1 cursor-pointer transition-all outline-none focus:ring-0
                                {{ $equipo->estatus == 'LISTO' ? 'bg-green-100 text-green-700 border-green-200' :
                                  ($equipo->estatus == 'EN PROCESO' ? 'bg-yellow-100 text-yellow-700 border-yellow-200' :
                                  'bg-red-100 text-red-700 border-red-200') }}">

                                <option value="RECIBIDO" {{ $equipo->estatus == 'RECIBIDO' ? 'selected' : '' }}>🔴 RECIBIDO</option>
                                <option value="EN PROCESO" {{ $equipo->estatus == 'EN PROCESO' ? 'selected' : '' }}>🟡 EN PROCESO</option>
                                <option value="LISTO" {{ $equipo->estatus == 'LISTO' ? 'selected' : '' }}>🟢 LISTO</option>
                            </select>
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded font-bold {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->isPast() ? 'bg-red-50 text-red-500' : 'bg-gray-100 text-gray-600' }}">
                                {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->format('d/m/Y') }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-2 min-w-[180px]">
                                @if(!$equipo->alerta_activa)
                                    <span class="inline-block px-3 py-1 rounded-full text-[9px] font-black uppercase bg-gray-100 text-gray-500 w-fit">
                                        Sin configurar
                                    </span>
                                @elseif(\Carbon\Carbon::parse($equipo->proximo_mantenimiento)->isPast())
                                    <span class="inline-block px-3 py-1 rounded-full text-[9px] font-black uppercase bg-red-100 text-red-600 w-fit">
                                        Vencida
                                    </span>
                                @elseif(\Carbon\Carbon::parse($equipo->proximo_mantenimiento)->isToday())
                                    <span class="inline-block px-3 py-1 rounded-full text-[9px] font-black uppercase bg-yellow-100 text-yellow-700 w-fit">
                                        Hoy
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full text-[9px] font-black uppercase bg-blue-100 text-blue-700 w-fit">
                                        Activa · {{ $equipo->dias_anticipacion_alerta }} día(s)
                                    </span>
                                @endif

                                <button
                                    type="button"
                                    wire:click="abrirModalAlerta({{ $equipo->id }})"
                                    class="px-3 py-2 rounded-lg bg-[#1E2A3B] text-white text-[10px] font-black uppercase hover:opacity-90 transition">
                                    Configurar
                                </button>

                                <form action="{{ route('equipos.alerta.enviar', $equipo->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-3 py-2 rounded-lg bg-[#DFFF00] text-black text-[10px] font-black uppercase hover:brightness-95 transition">
                                        Enviar ahora
                                    </button>
                                </form>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('clientes.show', $equipo->cliente_id) }}"
                               class="text-[10px] font-black text-gray-400 hover:text-black underline decoration-[#DFFF00] decoration-2 underline-offset-4">
                                EXPEDIENTE →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400 font-bold italic">
                            No se encontraron registros.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($mostrarModalAlerta && $equipoSeleccionado)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative max-h-[90vh] overflow-y-auto">
                <button
                    type="button"
                    wire:click="cerrarModalAlerta"
                    class="absolute top-4 right-4 text-gray-500 hover:text-black text-2xl leading-none">
                    ×
                </button>

                <h2 class="text-lg font-black uppercase text-[#1E2A3B] mb-4">
                    Configurar alerta
                </h2>

                <form action="{{ route('equipos.alerta.configurar', $equipoSeleccionado->id) }}" method="POST">
                    @csrf

                    <div class="mb-4 text-[12px] uppercase text-gray-600 font-bold space-y-1">
                        <p><span class="text-gray-800">Cliente:</span> {{ $equipoSeleccionado->cliente->nombre_cliente ?? 'N/A' }}</p>
                        <p><span class="text-gray-800">Equipo:</span> {{ $equipoSeleccionado->tipo_equipo }}</p>
                        <p><span class="text-gray-800">Correo:</span> {{ $equipoSeleccionado->cliente->correo ?? 'Sin correo' }}</p>
                        <p><span class="text-gray-800">Próximo mantenimiento:</span> {{ \Carbon\Carbon::parse($equipoSeleccionado->proximo_mantenimiento)->format('d/m/Y') }}</p>
                    </div>

                    <div class="space-y-4">
                        <label class="flex items-center gap-2 text-xs font-bold uppercase text-gray-700">
                            <input type="checkbox" name="alerta_activa" value="1"
                                class="rounded border-gray-300 text-black focus:ring-[#DFFF00]"
                                {{ $equipoSeleccionado->alerta_activa ? 'checked' : '' }}>
                            Activar alerta automática
                        </label>

                        <label class="flex items-center gap-2 text-xs font-bold uppercase text-gray-700">
                            <input type="checkbox" name="alerta_dias_antes" value="1"
                                class="rounded border-gray-300 text-black focus:ring-[#DFFF00]"
                                {{ $equipoSeleccionado->alerta_dias_antes ? 'checked' : '' }}>
                            Enviar días antes
                        </label>

                        <div>
                            <label class="block text-[11px] font-black uppercase text-gray-600 mb-1">
                                ¿Cuántos días antes?
                            </label>
                            <input type="number"
                                min="1"
                                max="365"
                                name="dias_anticipacion_alerta"
                                value="{{ $equipoSeleccionado->dias_anticipacion_alerta ?? 7 }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-[#DFFF00] focus:ring-[#DFFF00]">
                        </div>

                        <label class="flex items-center gap-2 text-xs font-bold uppercase text-gray-700">
                            <input type="checkbox" name="alerta_un_dia_antes" value="1"
                                class="rounded border-gray-300 text-black focus:ring-[#DFFF00]"
                                {{ $equipoSeleccionado->alerta_un_dia_antes ? 'checked' : '' }}>
                            Enviar 1 día antes
                        </label>

                        <label class="flex items-center gap-2 text-xs font-bold uppercase text-gray-700">
                            <input type="checkbox" name="alerta_mismo_dia" value="1"
                                class="rounded border-gray-300 text-black focus:ring-[#DFFF00]"
                                {{ $equipoSeleccionado->alerta_mismo_dia ? 'checked' : '' }}>
                            Enviar el mismo día
                        </label>

                        <label class="flex items-center gap-2 text-xs font-bold uppercase text-gray-700">
                            <input type="checkbox" name="alerta_vencido" value="1"
                                class="rounded border-gray-300 text-black focus:ring-[#DFFF00]"
                                {{ $equipoSeleccionado->alerta_vencido ? 'checked' : '' }}>
                            Enviar cuando esté vencido
                        </label>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button"
                            wire:click="cerrarModalAlerta"
                            class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-xs font-black uppercase">
                            Cancelar
                        </button>

                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-[#1E2A3B] text-white text-xs font-black uppercase">
                            Guardar configuración
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>