<div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-[#4A4A4A]">
        <h3 class="font-black text-sm uppercase mb-4 tracking-tighter text-gray-700">Registrar Nuevo Equipo</h3>
        
        @if (session()->has('mensaje'))
            <div class="bg-green-100 text-green-700 p-2 mb-4 text-xs font-bold uppercase rounded">
                {{ session('mensaje') }}
            </div>
        @endif

        <form wire:submit.prevent="guardar" class="space-y-4">
            <div>
                <label class="block text-[10px] font-black uppercase text-gray-500">Tipo</label>
                <select wire:model="tipo_equipo" class="w-full border-gray-300 rounded text-sm">
                    <option value="">Seleccionar...</option>
                    <option value="Impresora">Impresora</option>
                    <option value="Laptop">Laptop</option>
                    <option value="PC">PC Escritorio</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-gray-500">Marca / Modelo</label>
                <div class="grid grid-cols-2 gap-2">
                    <input type="text" wire:model="marca" placeholder="HP" class="w-full border-gray-300 rounded text-sm">
                    <input type="text" wire:model="modelo" placeholder="LaserJet" class="w-full border-gray-300 rounded text-sm">
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-gray-500">Número de Serie / SKU</label>
                <input type="text" wire:model="SKU" class="w-full border-gray-300 rounded text-sm font-mono">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-gray-500">Próximo Mantenimiento</label>
                <input type="date" wire:model="proximo_mantenimiento" class="w-full border-gray-300 rounded text-sm">
            </div>

            <button type="submit" class="w-full bg-[#4A4A4A] text-white py-3 rounded font-black text-xs uppercase hover:bg-black transition">
                Guardar en Expediente
            </button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase">Equipo</th>
                    <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase">Serie</th>
                    <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase">Mantenimiento</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($equipos as $equipo)
                <tr class="text-sm">
                    <td class="px-6 py-4 font-bold uppercase">{{ $equipo->tipo_equipo }} <span class="text-gray-400 font-normal">({{ $equipo->marca }})</span></td>
                    <td class="px-6 py-4 font-mono text-xs">{{ $equipo->SKU }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-[10px] font-black {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->isPast() ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->format('d/m/Y') }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>