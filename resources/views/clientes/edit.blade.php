<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 uppercase">Editar Cliente: {{ $cliente->nombre_cliente }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-[#4A4A4A]">
                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-xs font-bold mb-1 uppercase">Nombre del Cliente</label>
                        <input type="text" name="nombre_cliente" value="{{ $cliente->nombre_cliente }}" class="w-full border-gray-300 rounded-md focus:ring-[#DFFF00]">
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-bold mb-1 uppercase">Teléfono</label>
                            <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-xs font-bold mb-1 uppercase">Sector</label>
                            <select name="sector" class="w-full border-gray-200 rounded-md text-sm font-bold">
                                <option value="Educación" {{ $cliente->sector == 'Educación' ? 'selected' : '' }}>Educación</option>
                                <option value="Gobierno" {{ $cliente->sector == 'Gobierno' ? 'selected' : '' }}>Gobierno</option>
                                <option value="Particular" {{ $cliente->sector == 'Particular' ? 'selected' : '' }}>Particular</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold mb-1 uppercase">Correo Electrónico</label>
                        <input type="email" name="correo" value="{{ $cliente->correo }}" class="w-full border-gray-300 rounded-md">
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-[#4A4A4A] text-white py-3 rounded-md font-black uppercase hover:bg-black transition">
                            Actualizar Datos
                        </button>
                        <a href="{{ route('clientes.index') }}" class="flex-1 bg-gray-100 text-center py-3 rounded-md font-black uppercase text-gray-600 hover:bg-gray-200">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>