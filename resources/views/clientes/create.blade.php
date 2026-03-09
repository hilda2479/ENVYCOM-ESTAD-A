<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-xl text-gray-800 uppercase">Gestión de Clientes</h2>
            <a href="{{ route('clientes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md text-sm">
               ← Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto">
        @if(session('mensaje'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('mensaje') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-[#4A4A4A]">
            <h3 class="font-bold mb-4 uppercase">Nuevo Registro</h3>

            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">NOMBRE DEL CLIENTE</label>
                    <input type="text" name="nombre_cliente" value="{{ old('nombre_cliente') }}" class="w-full border-gray-300 rounded-md">
                    @error('nombre_cliente') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">TELÉFONO</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}" class="w-full border-gray-300 rounded-md">
                    @error('telefono') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">CORREO</label>
                    <input type="email" name="correo" value="{{ old('correo') }}" class="w-full border-gray-300 rounded-md">
                    @error('correo') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">SECTOR</label>
                    <select name="sector" class="w-full border-gray-300 rounded-md">
                        <option value="">Seleccionar...</option>
                        <option value="Educación" {{ old('sector') == 'Educación' ? 'selected' : '' }}>Educación</option>
                        <option value="Gobierno" {{ old('sector') == 'Gobierno' ? 'selected' : '' }}>Gobierno</option>
                        <option value="Particular" {{ old('sector') == 'Particular' ? 'selected' : '' }}>Particular</option>
                    </select>
                    @error('sector') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full bg-[#4A4A4A] text-white py-2 rounded-md font-bold hover:bg-black">
                    REGISTRAR CLIENTE
                </button>
            </form>
        </div>
    </div>
</x-app-layout>