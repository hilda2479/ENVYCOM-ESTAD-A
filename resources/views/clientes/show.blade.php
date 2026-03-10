<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-gray-800 uppercase">
                EXPEDIENTE: {{ $cliente->nombre_cliente }}
            </h2>

            <a href="{{ route('clientes.index') }}"
               class="text-sm font-bold text-gray-500 hover:text-black uppercase">
                ← Volver a la lista
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @livewire('gestionar-equipos', ['clienteId' => $cliente->id])
    </div>
</x-app-layout>