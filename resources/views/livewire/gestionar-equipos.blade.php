<div>
    <div class="flex justify-between items-center mb-8">
        <h2 class="font-black text-xl text-gray-800 uppercase italic">
            Inventario del cliente
        </h2>

        <button wire:click="abrirFormulario"
                class="bg-[#4A4A4A] hover:bg-black text-white font-black uppercase px-6 py-3 rounded-lg shadow transition">
            + Registrar nuevo equipo
        </button>
    </div>

    @if (session()->has('mensaje'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg font-bold uppercase text-xs">
            {{ session('mensaje') }}
        </div>
    @endif

    @if($mostrarFormulario)
        <div class="bg-white shadow-xl rounded-lg p-6 mb-8 border-t-4 border-[#DFFF00]">
            <h3 class="text-lg font-black uppercase text-gray-800 mb-4 tracking-tighter">Nuevo equipo en expediente</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Tipo de equipo</label>
                    <input type="text" wire:model.defer="tipo_equipo" class="w-full rounded-lg border-gray-300 text-sm" placeholder="Ej. Laptop">
                    @error('tipo_equipo') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Marca</label>
                    <input type="text" wire:model.defer="marca" class="w-full rounded-lg border-gray-300 text-sm" placeholder="Ej. HP">
                    @error('marca') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Modelo</label>
                    <input type="text" wire:model.defer="modelo" class="w-full rounded-lg border-gray-300 text-sm" placeholder="Ej. ProBook 440">
                    @error('modelo') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Serie / SKU</label>
                    <input type="text" wire:model.defer="SKU" class="w-full rounded-lg border-gray-300 text-sm font-mono" placeholder="ABC123456">
                    @error('SKU') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Próximo Mantenimiento</label>
                    <input type="date" wire:model.defer="proximo_mantenimiento" class="w-full rounded-lg border-gray-300 text-sm">
                    @error('proximo_mantenimiento') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-500 mb-1">Estado Inicial</label>
                    <select wire:model="estatus" class="w-full border-gray-300 rounded-lg text-sm uppercase font-black">
                        <option value="RECIBIDO">🔴 RECIBIDO</option>
                        <option value="EN PROCESO">🟡 EN PROCESO</option>
                        <option value="LISTO">🟢 LISTO</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <button wire:click="guardar" class="bg-[#DFFF00] hover:bg-black hover:text-white text-black font-black uppercase px-6 py-3 rounded-lg shadow transition text-xs">
                    Guardar equipo
                </button>
                <button wire:click="cerrarFormulario" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-black uppercase px-6 py-3 rounded-lg text-xs transition">
                    Cancelar
                </button>
            </div>
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-lg overflow-hidden border-t-4 border-[#4A4A4A]">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 uppercase text-[10px] font-black text-gray-500 italic">
                <tr>
                    <th class="px-6 py-4 text-left">Equipo / Marca</th>
                    <th class="px-6 py-3 text-left">Serie / SKU</th>
                    <th class="px-6 py-3 text-left">Estado</th>
                    <th class="px-6 py-3 text-left">Mantenimiento</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 uppercase text-[11px]">
                @forelse($equipos as $equipo)
                    <tr class="hover:bg-gray-50 transition-colors" wire:key="equipo-{{ $equipo->id }}">
                        <td class="px-6 py-4 font-bold">
                            {{ $equipo->tipo_equipo }} 
                            <span class="text-gray-400 font-normal">({{ $equipo->marca }} {{ $equipo->modelo }})</span>
                        </td>

                        <td class="px-6 py-4 font-mono text-gray-500">
                            {{ $equipo->SKU ?? '-' }}
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
                            <span class="px-2 py-1 rounded font-bold {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->isPast() ? 'bg-red-50 text-red-500' : 'bg-gray-50 text-gray-600' }}">
                                {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->format('d/m/Y') }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400 font-black uppercase italic tracking-tighter">
                            Este cliente aún no tiene equipos registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>