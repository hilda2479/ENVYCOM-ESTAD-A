<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-gray-800 uppercase">Lista de Clientes</h2>
            <a href="{{ route('clientes.create') }}" class="bg-[#4A4A4A] text-white px-4 py-2 rounded-md font-bold text-sm">
                + REGISTRAR NUEVO CLIENTE
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('mensaje'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 font-bold uppercase text-xs">
                {{ session('mensaje') }}
            </div>
        @endif

        <div class="bg-white shadow-xl sm:rounded-lg p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-500 uppercase">Sector</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-500 uppercase">Teléfono</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-500 uppercase">Correo</th>
                        <th class="px-6 py-3 text-left text-xs font-black text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @foreach($clientes as $cliente)
                    <tr>
                        <td class="px-6 py-4 font-bold text-gray-900 uppercase">{{ $cliente->nombre_cliente }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $cliente->sector }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $cliente->telefono }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $cliente->correo }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('clientes.show', $cliente) }}"
                                    class="inline-block px-4 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded hover:bg-black">
                                    Ver equipos
                                </a>

                                <a href="{{ route('clientes.edit', $cliente->id) }}" 
                                   class="text-gray-500 hover:text-blue-600 font-bold text-[10px] uppercase tracking-wider flex items-center transition">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Editar
                                </a>

                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este cliente y todo su historial de equipos?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-[10px] uppercase tracking-wider flex items-center transition">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>