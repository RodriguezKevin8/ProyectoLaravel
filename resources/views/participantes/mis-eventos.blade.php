<x-app-layout>
    <x-slot name="content">
        <!-- Fondo degradado -->
        <div class="flex items-center justify-center p-6 bg-gradient-to-br from-indigo-600 to-purple-600">
            <!-- Contenedor principal -->
            <div class="w-full max-w-6xl bg-white shadow-2xl rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Mis Eventos Inscritos</h2>

                @if($participaciones->isEmpty())
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
                        <p>No estás inscrito en ningún evento.</p>
                    </div>
                @else
                    <!-- Tabla responsiva -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700">
                            <thead class="text-xs uppercase bg-indigo-100 text-indigo-800">
                                <tr>
                                    <th scope="col" class="px-4 py-3">ID</th>
                                    <th scope="col" class="px-4 py-3">Evento</th>
                                    <th scope="col" class="px-4 py-3">Organizador</th>
                                    <th scope="col" class="px-4 py-3">Estado</th>
                                    <th scope="col" class="px-4 py-3">Inscripción</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($participaciones as $participacion)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $participacion->id }}</td>
                                        <td class="px-4 py-2">
                                            @if($participacion->evento)
                                                <div class="font-semibold">{{ $participacion->evento->titulo }}</div>
                                                <div class="text-xs text-gray-500">{{ $participacion->evento->descripcion }}</div>
                                            @else
                                                <span class="text-red-600 font-semibold">Evento eliminado</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $participacion->evento->creador->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="inline-block px-2 py-1 text-xs font-medium rounded-full
                                                @if($participacion->estado_participante == 'CONFIRMADO')
                                                    bg-green-100 text-green-800
                                                @else
                                                    bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ $participacion->estado_participante }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $participacion->created_at->format('d/m/Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
</x-app-layout>
