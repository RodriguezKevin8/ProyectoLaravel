<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl px-6 py-4 shadow-md flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="bg-white p-2 rounded-full">
                    <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.104 0 2-.672 2-1.5S13.104 5 12 5s-2 .672-2 1.5S10.896 8 12 8zm0 2c-1.104 0-2 .672-2 1.5S10.896 13 12 13s2-.672 2-1.5S13.104 10 12 10zm0 2c-1.104 0-2 .672-2 1.5S10.896 15 12 15s2-.672 2-1.5S13.104 12 12 12z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-white">{{ $evento->titulo }}</h2>
                    <p class="text-sm text-indigo-100">Detalles y gestión de participación</p>
                </div>
            </div>

            @if(auth()->user()->isAdmin)
                <div class="flex gap-2">
                    <a href="{{ route('evento.edit', $evento) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                    <button @click="showModal = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Eliminar
                    </button>
                </div>
            @endif
        </div>
    </x-slot>

    <!-- Modal de confirmación -->
    <div x-data="{ showModal: false }" x-cloak>
        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center transition-opacity bg-black bg-opacity-50">
            <div @click.away="showModal = false" class="w-full max-w-md p-6 mx-4 transition-all transform bg-white rounded-xl shadow-2xl">
                <h3 class="text-xl font-semibold text-gray-900">¿Eliminar evento?</h3>
                <p class="mt-2 text-gray-600">Esta acción no se puede deshacer.</p>
                <div class="flex justify-end mt-6 space-x-3">
                    <button @click="showModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Cancelar
                    </button>
                    <form action="{{ route('evento.destroy', $evento) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                            Sí, eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido del evento -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session()->has('message'))
                <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">{{ session('message') }}</span>
                    </div>
                </div>
            @endif

            <!-- Tarjeta -->
            <div class="bg-white shadow rounded-xl p-6 space-y-6">
                <!-- Descripción -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Descripción del evento</h3>
                    <p class="mt-2 text-gray-600">{{ $evento->descripcion }}</p>
                </div>

                <!-- Detalles -->
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Fechas</h4>
                            <p class="text-gray-700 mt-1"><strong>Inicio:</strong> {{ $evento->fecha_inicio->format('d/m/Y H:i') }}</p>
                            <p class="text-gray-700"><strong>Fin:</strong> {{ $evento->fecha_fin->format('d/m/Y H:i') }}</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Estado</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($evento->estado == 'ACTIVO') bg-green-100 text-green-800
                                @elseif($evento->estado == 'INACTIVO') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $evento->estado }}
                            </span>
                        </div>
                    </div>

                    <!-- Organizador y participación -->
                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Organizador</h4>
                            <div class="flex items-center mt-1">
                                <div class="w-10 h-10 bg-indigo-100 text-indigo-600 font-bold rounded-full flex items-center justify-center">
                                    {{ substr($evento->creador->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $evento->creador->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $evento->creador->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Participación</h4>
                            <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">
                                {{ $evento->participantes()->where('estado_participante', 'CONFIRMADO')->count() }} confirmados
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Lista de participantes (si organizador) -->
                @if(auth()->user()->id == $evento->user_id)
                    <h4 class="text-lg mt-4 font-semibold text-gray-800">Participantes</h4>
                    @forelse($evento->participantes as $p)
                        <div class="bg-gray-50 p-4 rounded-lg shadow-inner space-y-1">
                            <p><strong>Nombre:</strong> {{ $p->usuario()->first()->name }}</p>
                            <p><strong>Apellido:</strong> {{ $p->usuario()->first()->apellido }}</p>
                            <p><strong>Email:</strong> {{ $p->usuario()->first()->email }}</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($p->estado_participante == 'CONFIRMADO') bg-green-100 text-green-800
                                @elseif($p->estado_participante == 'PENDIENTE') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $p->estado_participante }}
                            </span>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">No hay participantes aún.</p>
                    @endforelse
                @endif

                <!-- Participación del usuario -->
                @if(auth()->user()->id != $evento->user_id)
                    @if($participante != null)
                        <div class="p-6 mt-8 rounded-lg bg-gray-50">
                            <h3 class="text-lg font-medium text-gray-900">Mi participación</h3>
                            <div class="mt-4 space-y-6">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Estado actual</h4>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        @if($participante->estado_participante == 'CONFIRMADO') bg-green-100 text-green-800
                                        @elseif($participante->estado_participante == 'PENDIENTE') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $participante->estado_participante }}
                                    </span>
                                </div>

                                <!-- Cambiar estado -->
                                <form action="{{ route('participante.update', $evento) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        <select name="estado_participante" class="w-full sm:w-auto px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="CONFIRMADO" {{ $participante->estado_participante == 'CONFIRMADO' ? 'selected' : '' }}>Confirmado</option>
                                            <option value="PENDIENTE" {{ $participante->estado_participante == 'PENDIENTE' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="RECHAZADO" {{ $participante->estado_participante == 'RECHAZADO' ? 'selected' : '' }}>Rechazado</option>
                                        </select>
                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Actualizar</button>
                                    </div>
                                </form>

                                <!-- Abandonar -->
                                <form action="{{ route('participante.destroy', $evento) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de abandonar este evento?')" class="mt-4 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                                        Abandonar evento
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="p-6 mt-8 text-center bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">¿Te gustaría participar?</h3>
                            <p class="text-gray-600">Confirma tu asistencia para unirte al evento.</p>
                            <form action="{{ route('participante.store', $evento) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Confirmar asistencia
                                </button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
