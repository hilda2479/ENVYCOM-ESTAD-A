<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-gray-800 uppercase">
                EXPEDIENTE: {{ $cliente->nombre_cliente }}
            </h2>
            <a href="{{ route('clientes.index') }}" class="text-sm font-bold text-gray-500 hover:text-black uppercase">
                ← Volver a la lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6 flex gap-8 border-l-4 border-[#DFFF00]">
                <div>
                    <p class="text-xs font-bold text-gray-400">TELÉFONO</p>
                    <p class="font-bold">{{ $cliente->telefono }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400">CORREO</p>
                    <p class="font-bold">{{ $cliente->correo }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400">SECTOR</p>
                    <span class="px-2 py-1 bg-gray-100 rounded text-xs font-black uppercase">{{ $cliente->sector }}</span>
                </div>
            </div>

            @livewire('gestionar-equipos', ['clienteId' => $cliente->id])

        </div>
    </div>
</x-app-layout>