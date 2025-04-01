<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl px-6 py-4 shadow-md flex items-center gap-3">
            <div class="bg-white p-2 rounded-full">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 4H7a2 2 0 01-2-2V8a2 2 0 012-2h10a2 2 0 012 2v6a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">Eventos</h2>
                <p class="text-sm text-indigo-100">Explora y gestiona tus eventos</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Filtro y botón -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                @can('create', App\Models\Evento::class)
                    <a href="{{ route('evento.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Crear Evento
                    </a>
                @endcan

                <form method="GET" action="{{ route('evento.index') }}" class="flex items-center gap-2">
                    <label for="estado" class="text-sm font-medium text-gray-700 hidden md:inline">Filtrar por estado:</label>
                    <select id="estado" name="estado" onchange="this.form.submit()" class="block w-full md:w-48 p-2 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todos los eventos</option>
                        <option value="ACTIVO" {{ request('estado') == 'ACTIVO' ? 'selected' : '' }}>Activos</option>
                        <option value="INACTIVO" {{ request('estado') == 'INACTIVO' ? 'selected' : '' }}>Inactivos</option>
                        <option value="FINALIZADO" {{ request('estado') == 'FINALIZADO' ? 'selected' : '' }}>Finalizados</option>
                    </select>
                </form>
            </div>

            <!-- Mensaje -->
            @if(session()->has('message'))
                <p class="text-center font-semibold text-green-600">{{ session('message') }}</p>
            @endif

            <!-- Tarjetas de eventos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($eventos as $evento)
                    <div class="bg-white shadow rounded-xl p-5 space-y-3 hover:shadow-xl transition">
                        <h3 class="text-lg font-bold text-gray-800 truncate">{{ $evento->titulo }}</h3>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $evento->descripcion }}</p>
                        <div class="text-xs text-gray-500 space-y-1">
                            <p><strong>Inicio:</strong> {{ $evento->fecha_inicio->format('d/m/Y H:i') }}</p>
                            <p><strong>Fin:</strong> {{ $evento->fecha_fin->format('d/m/Y H:i') }}</p>
                            <p><strong>Estado:</strong>
                                <span class="@if($evento->estado == 'ACTIVO') text-green-600
                                            @elseif($evento->estado == 'INACTIVO') text-gray-600
                                            @else text-red-600 @endif font-semibold">
                                    {{ $evento->estado }}
                                </span>
                            </p>
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-wrap gap-2 pt-2">
                            <a href="{{ route('evento.show', $evento) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Ver
                            </a>

                            @can('update', $evento)
                                <a href="{{ route('evento.edit', $evento) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded hover:bg-blue-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                                    </svg>
                                    Editar
                                </a>
                                <form action="{{ route('evento.destroy', $evento) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este evento?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded hover:bg-red-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            @endcan

                            @can('manageParticipants', $evento)
                                <a href="{{ route('participante.create', ['evento_id' => $evento->id]) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded hover:bg-purple-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3M6 9v3m6-6v12m6 0H6" />
                                    </svg>
                                    Participantes
                                </a>
                            @endcan
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No hay eventos para mostrar.</p>
                @endforelse
            </div>

            <!-- Paginación -->
            <div class="pt-6">
                {{ $eventos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
