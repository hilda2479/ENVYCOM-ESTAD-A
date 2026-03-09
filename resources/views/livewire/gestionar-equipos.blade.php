<div class="mt-8">
    @if (session()->has('mensaje'))
        <div class="bg-green-100 border-l-4 border-[#DFFF00] text-green-800 p-4 mb-6 font-bold uppercase text-xs">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-[#4A4A4A]">
                <h3 class="font-black text-sm uppercase mb-4 text-gray-700 underline decoration-[#DFFF00] decoration-4">
                    Vincular Nuevo Equipo
                </h3>

                <form wire:submit.prevent="guardarEquipo" class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Tipo de Equipo</label>
                        <select wire:model="tipo_equipo" class="w-full border-gray-200 rounded-md text-sm font-bold focus:ring-[#DFFF00]">
                            <option value="">Seleccionar...</option>
                            <option value="Impresora">Impresora</option>
                            <option value="Laptop">Laptop</option>
                            <option value="PC Escritorio">PC Escritorio</option>
                            <option value="Servidor">Servidor</option>
                            <option value="Otro">Otro</option>
                        </select>
                        @error('tipo_equipo') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase">Marca</label>
                            <input type="text" wire:model="marca" class="w-full border-gray-200 rounded-md text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase">Modelo</label>
                            <input type="text" wire:model="modelo" class="w-full border-gray-200 rounded-md text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase">SKU / Serie</label>
                        <input type="text" wire:model="SKU" class="w-full border-gray-200 rounded-md text-sm font-mono" placeholder="Ej: ENVY-1234">
                        @error('SKU') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase">Fecha de Entrega</label>
                        <input type="date" wire:model="fecha" class="w-full border-gray-200 rounded-md text-sm">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase text-red-600">Próximo Mantenimiento</label>
                        <input type="date" wire:model="proximo_mantenimiento" class="w-full border-gray-200 rounded-md text-sm border-red-200">
                    </div>

                    <button type="submit" class="w-full bg-[#4A4A4A] text-white py-3 rounded-md font-black text-xs uppercase hover:bg-black transition shadow-md">
                        REGISTRAR HARDWARE
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                <div class="bg-gray-50 px-6 py-4 border-b">
                    <h3 class="font-black text-xs uppercase tracking-widest text-gray-600">Inventario Técnico Instalado</h3>
                </div>
                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase">Equipo</th>
                            <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase">Marca/Modelo</th>
                            <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase">SKU</th>
                            <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase">Mantenimiento</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($equipos as $equipo)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="text-sm font-black text-gray-800 uppercase">{{ $equipo->tipo_equipo }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 uppercase font-bold">
                                {{ $equipo->marca }} <span class="text-gray-400 font-normal">/</span> {{ $equipo->modelo }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs font-mono font-bold">{{ $equipo->SKU }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->isPast() ? 'text-red-500' : 'text-green-600' }}">
                                    {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->format('d/m/Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="bg-[#DFFF00] text-black px-3 py-1 rounded text-[10px] font-black uppercase hover:shadow-md">
                                    Historial
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic text-sm">
                                No hay equipos registrados para este cliente.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>