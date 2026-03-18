<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 uppercase">
            Archivos del cliente: {{ $cliente->nombre_cliente }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('mensaje'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg font-bold uppercase text-xs">
                    {{ session('mensaje') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg font-bold uppercase text-xs">
                    Revisa los datos del formulario.
                </div>
            @endif

            <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-[#DFFF00] mb-8">
                <h3 class="text-lg font-black uppercase text-gray-800 mb-4">
                    Subir nuevo archivo
                </h3>

                <form action="{{ route('clientes.archivos.subir', $cliente->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-xs font-bold mb-2 uppercase text-gray-700">
                            Seleccionar archivo
                        </label>

                        <input type="file"
                               name="archivo"
                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                               class="w-full border border-gray-300 rounded-md p-2 text-sm bg-white">

                        <p class="text-xs text-gray-500 mt-2">
                            Formatos permitidos: PDF, JPG, PNG, Word y Excel. Tamaño máximo sugerido: 10 MB.
                        </p>

                        @error('archivo')
                            <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit"
                            class="bg-[#DFFF00] hover:bg-black hover:text-white text-black font-black uppercase px-6 py-3 rounded-md shadow transition text-xs">
                            Subir archivo
                        </button>

                        <a href="{{ route('clientes.show', $cliente->id) }}"
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-black uppercase px-6 py-3 rounded-md transition text-xs">
                            Volver al expediente
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-md border-t-4 border-[#4A4A4A] overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-black uppercase text-gray-800">
                        Archivos registrados
                    </h3>
                </div>

                @if(isset($cliente->documentos) && $cliente->documentos->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 uppercase text-[10px] font-black text-gray-500 tracking-widest">
                                <tr>
                                    <th class="px-6 py-4 text-left">Archivo</th>
                                    <th class="px-6 py-4 text-left">Tipo</th>
                                    <th class="px-6 py-4 text-left">Peso</th>
                                    <th class="px-6 py-4 text-left">Fecha</th>
                                    <th class="px-6 py-4 text-right">Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 text-[11px] font-bold text-gray-700">
                                @foreach($cliente->documentos as $documento)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 normal-case">
                                            {{ $documento->nombre_original }}
                                        </td>

                                        <td class="px-6 py-4 uppercase text-gray-500">
                                            {{ $documento->extension }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ number_format(($documento->peso ?? 0) / 1024, 1) }} KB
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $documento->created_at->format('d/m/Y') }}
                                        </td>

                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('clientes.documentos.descargar', $documento->id) }}"
                                               class="inline-block text-blue-600 hover:text-blue-800 text-[10px] font-black uppercase mr-4">
                                                Descargar
                                            </a>

                                            <form action="{{ route('clientes.documentos.eliminar', $documento->id) }}"
                                                  method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('¿Deseas eliminar este archivo?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 text-[10px] font-black uppercase">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-10 text-center text-gray-400 font-bold uppercase text-sm">
                        Este cliente aún no tiene archivos registrados.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>