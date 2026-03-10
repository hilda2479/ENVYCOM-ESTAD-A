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
                    <th class="px-6 py-4 text-left">Estado</th> <th class="px-6 py-4 text-left">Mantenimiento</th>
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

                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('clientes.show', $equipo->cliente_id) }}" 
                           class="text-[10px] font-black text-gray-400 hover:text-black underline decoration-[#DFFF00] decoration-2 underline-offset-4">
                            EXPEDIENTE →
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400 font-bold italic">
                        No se encontraron registros.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>