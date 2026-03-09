<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-4">
            <h2 class="text-2xl font-black uppercase text-gray-800">Gestión de Clientes</h2>
            <!-- Botón de regresar -->
            <a href="{{ route('clientes.index') }}" 
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md text-sm transition">
               ← Regresar
            </a>
        </div>

        <input wire:model.live="busqueda" type="text" placeholder="Buscar cliente..." class="border-gray-300 rounded-lg shadow-sm w-1/3">
    </div>

    @if (session()->has('mensaje'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-[#4A4A4A]">
            <h3 class="font-bold mb-4 uppercase">Nuevo Registro</h3>
            <form wire:submit.prevent="guardarCliente">
                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">NOMBRE DEL CLIENTE</label>
                    <input type="text" wire:model="nombre_cliente" class="w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">TELÉFONO</label>
                    <input type="text" wire:model="telefono" class="w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">CORREO</label>
                    <input type="email" wire:model="correo" class="w-full border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-bold mb-1">SECTOR</label>
                    <select wire:model="sector" class="w-full border-gray-300 rounded-md">
                        <option value="">Seleccionar...</option>
                        <option value="Educación">Educación</option>
                        <option value="Gobierno">Gobierno</option>
                        <option value="Particular">Particular</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-[#4A4A4A] text-white py-2 rounded-md font-bold hover:bg-black transition">
                    REGISTRAR CLIENTE
                </button>
            </form>
        </div>

        <div class="md:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Sector</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @foreach($clientes as $cliente)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $cliente->nombre_cliente }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-bold 
                                {{ $cliente->sector == 'Gobierno' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                {{ $cliente->sector }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-blue-600 font-bold hover:underline">Ver Equipos</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>