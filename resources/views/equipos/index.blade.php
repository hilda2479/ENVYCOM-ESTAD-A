<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 uppercase italic">Inventario Global</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden border-t-4 border-[#4A4A4A]">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 uppercase text-[10px] font-black text-gray-500">
                    <tr>
                        <th class="px-6 py-3 text-left">Propietario</th>
                        <th class="px-6 py-3 text-left">Equipo</th>
                        <th class="px-6 py-3 text-left">Serie / SKU</th>
                        <th class="px-6 py-3 text-left">Mantenimiento</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 uppercase text-xs">
                    @foreach($equipos as $equipo)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-black text-blue-600">
                            {{ $equipo->cliente->nombre_cliente }}
                        </td>
                        <td class="px-6 py-4 font-bold">
                            {{ $equipo->tipo_equipo }} <span class="text-gray-400">({{ $equipo->marca }})</span>
                        </td>
                        <td class="px-6 py-4 font-mono">{{ $equipo->SKU }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->isPast() ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                {{ \Carbon\Carbon::parse($equipo->proximo_mantenimiento)->format('d/m/Y') }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>