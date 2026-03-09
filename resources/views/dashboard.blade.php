<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ENVYCOM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <h3 class="text-lg font-bold">Clientes Totales</h3>
                    <p class="text-3xl font-extrabold text-blue-600">0</p>
                    <a href="{{ route('clientes.index') }}" class="text-sm text-blue-500 underline">Ver lista de clientes</a>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-green-500">
                    <h3 class="text-lg font-bold">Equipos Registrados</h3>
                    <p class="text-3xl font-extrabold text-green-600">0</p>
                    <a href="{{ route('equipos.index') }}" class="text-sm text-green-500 underline">Gestionar inventario</a>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border-l-4 border-red-500">
                    <h3 class="text-lg font-bold italic">Alertas de Mantenimiento</h3>
                    <p class="text-3xl font-extrabold text-red-600">0</p>
                    <span class="text-sm text-gray-500 italic text-pretty">Equipos que requieren atención pronto</span>
                </div>
                
            </div>
            
        </div>
    </div>
</x-app-layout>