<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl px-6 py-4 shadow-md flex items-center gap-3">
            <div class="bg-white p-2 rounded-full">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A7.5 7.5 0 1118.88 6.196 7.5 7.5 0 015.12 17.804z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">Participantes</h2>
                <p class="text-sm text-indigo-100">Revisa los asistentes a tus eventos</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Filtro y botón -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                @can('create', App\Models\Participante::class)
                    <a href="{{ route('participante.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Registrar Participante
                    </a>
                @endcan

                <form method="GET" action="{{ route('participante.index') }}" class="flex items-center gap-2">
                    <label for="estado" class="text-sm font-medium text-gray-700 hidden md:inline">Filtrar por estado:</label>
                    <select id="estado" name="estado" onchange="this.form.submit()" class="block w-full md:w-48 p-2 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Todos los estados</option>
                        <option value="CONFIRMADO" {{ request('estado') == 'CONFIRMADO' ? 'selected' : '' }}>Confirmados</option>
                        <option value="PENDIENTE" {{ request('estado') == 'PENDIENTE' ? 'selected' : '' }}>Pendientes</option>
                        <option value="CANCELADO" {{ request('estado') == 'CANCELADO' ? 'selected' : '' }}>Cancelados</option>
                    </select>
                </form>
            </div>

            @if(session()->has('message'))
                <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg">
                    <p class="text-sm font-semibold text-center">{{ session('message') }}</p>
                </div>
            @endif

            <!-- Tarjetas de participantes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($participantes as $participante)
                    <div class="bg-white shadow-lg rounded-xl p-5 space-y-3 hover:shadow-xl transition">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-800">
                                {{ $participante->usuario->name ?? 'Usuario no disponible' }}
                            </h3>
                            <span class="px-2 py-1 text-xs font-semibold rounded
                                @if($participante->estado_participante == 'CONFIRMADO') bg-green-100 text-green-800
                                @elseif($participante->estado_participante == 'PENDIENTE') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $participante->estado_participante }}
                            </span>
                        </div>

                        <div class="text-sm text-gray-600">
                            <p><strong>Evento:</strong> {{ $participante->evento->titulo ?? 'Evento no disponible' }}</p>
                            <p><strong>Inscripción:</strong> {{ $participante->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-2">
                            <a href="{{ route('evento.show', $participante->evento->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Ver Evento
                            </a>

                            @can('update', $participante)
                                <a href="{{ route('participante.edit', $participante) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded hover:bg-blue-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>
                                    </svg>
                                    Editar
                                </a>
                            @endcan

                            @can('delete', $participante)
                                <form action="{{ route('participante.destroy', $participante) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta participación?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded hover:bg-red-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"/>
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">No hay participantes registrados.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
