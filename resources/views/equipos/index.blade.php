<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-black text-gray-800 uppercase italic">
        Inventario Global
    </h2>
    
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" 
                class="bg-red-600 hover:bg-black text-white px-4 py-2 rounded-lg text-xs font-black uppercase transition flex items-center shadow-lg">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Descargar Reporte
            <svg class="w-3 h-3 ml-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
            </svg>
        </button>

        <div x-show="open" @click.away="open = false" 
             class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-xl z-50 overflow-hidden">
            <div class="bg-gray-100 px-4 py-2 text-[10px] font-black text-gray-400 uppercase">Selecciona Periodo</div>
            
            <a href="{{ route('reportes.periodo', 'diario') }}" class="block px-4 py-2 text-xs font-bold text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                📅 Reporte de Hoy
            </a>
            <a href="{{ route('reportes.periodo', 'semanal') }}" class="block px-4 py-2 text-xs font-bold text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                📊 Esta Semana
            </a>
            <a href="{{ route('reportes.periodo', 'mensual') }}" class="block px-4 py-2 text-xs font-bold text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                📈 Mes Actual
            </a>
    </div>
</div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @livewire('buscador-equipos')

    </div>
</x-app-layout>