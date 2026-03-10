<div>
    <div class="flex justify-between items-center mb-8">
        <h2 class="font-black text-xl text-gray-800 uppercase italic">
            Inventario del cliente
        </h2>

        <button wire:click="abrirFormulario"
                class="bg-[#4A4A4A] hover:bg-black text-white font-black uppercase px-6 py-3 rounded-lg shadow">
            + Registrar nuevo equipo
        </button>
    </div>

    @if (session()->has('mensaje'))
        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            {{ session('mensaje') }}
        </div>
    @endif

    @if($mostrarFormulario)
        <div class="bg-white shadow-xl rounded-lg p-6 mb-8 border-t-4 border-[#DFFF00]">
            <h3 class="text-lg font-black uppercase text-gray-800 mb-4">Nuevo equipo</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black uppercase text-gray-500 mb-2">Tipo de equipo</label>
                    <input type="text"
                           wire:model.defer="tipo_equipo"
                           class="w-full rounded-lg border-gray-300"
                           placeholder="Ej. Laptop">
                    @error('tipo_equipo')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-500 mb-2">Marca</label>
                    <input type="text"
                           wire:model.defer="marca"
                           class="w-full rounded-lg border-gray-300"
                           placeholder="Ej. HP">
                    @error('marca')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-500 mb-2">Modelo</label>
                    <input type="text"
                           wire:model.defer="modelo"
                           class="w-full rounded-lg border-gray-300"
                           placeholder="Ej. ProBook 440">
                    @error('modelo')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-500 mb-2">Serie / SKU</label>
                    <input type="text"
                           wire:model.defer="SKU"
                           class="w-full rounded-lg border-gray-300"
                           placeholder="Ej. ABC123456">
                    @error('SKU')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-500 mb-2">Fecha</label>
                    <input type="date"
                        wire:model.defer="fecha"
                        class="w-full rounded-lg border-gray-300">
                    @error('fecha')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-gray-500 mb-2">Próximo mantenimiento</label>
                    <input type="date"
                           wire:model.defer="proximo_mantenimiento"
                           class="w-full rounded-lg border-gray-300">
                    @error('proximo_mantenimiento')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <button wire:click="guardar"
                        class="bg-[#DFFF00] hover:bg-lime-300 text-black font-black uppercase px-6 py-3 rounded-lg shadow">
                    Guardar equipo
                </button>

                <button wire:click="cerrarFormulario"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-black uppercase px-6 py-3 rounded-lg shadow">
                    Cancelar
                </button>
            </div>
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-lg overflow-hidden border-t-4 border-[#4A4A4A]">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 uppercase text-[10px] font-black text-gray-500">
                <tr>
                    <th class="px-6 py-3 text-left">Propietario</th>
                    <th class="px-6 py-3 text-left">Equipo</th>
                    <th class="px-6 py-3 text-left">Serie / SKU</th>
                    <th class="px-6 py-3 text-left">Proximo Mantenimiento</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 uppercase text-xs">
                @forelse($equipos as $equipo)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-black text-blue-600">
                            {{ $equipo->cliente->nombre_cliente }}
                        </td>

                        <td class="px-6 py-4 font-bold">
                            {{ $equipo->tipo_equipo ?? '-' }}
                            @if(!empty($equipo->marca))
                                <span class="text-gray-400">({{ $equipo->marca }} {{ $equipo->modelo }})</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 font-mono">
                            {{ $equipo->SKU ?? '-' }}
                        </td>
                        

                        <td class="px-6 py-4">
                            @if(!empty($equipo->proximo_mantenimiento))
                                <span class="px-2 py-1 rounded {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->isPast() ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                    {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->format('d/m/Y') }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 font-bold uppercase">
                            Este cliente aún no tiene equipos registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>