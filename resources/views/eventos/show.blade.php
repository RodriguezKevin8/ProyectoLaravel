<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">{{ $evento->titulo }}</h2>
            @if(auth()->user()->isAdmin)
            <div class="flex space-x-2">
                <a href="{{ route('evento.edit', $evento) }}" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar
                </a>
                <button @click="showModal = true" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Eliminar
                </button>
            </div>
            @endif
        </div>
    </x-slot>

    <!-- Modal de confirmación de eliminación -->
    <div x-data="{ showModal: false }" x-cloak>
        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity">
            <div @click.away="showModal = false" class="w-full max-w-md p-6 mx-4 bg-white rounded-lg shadow-xl transform transition-all">
                <h3 class="text-xl font-semibold text-gray-900">Confirmar Eliminación</h3>
                <p class="mt-2 text-gray-600">¿Estás seguro de eliminar este evento? Esta acción no se puede deshacer.</p>
                <div class="flex justify-end mt-6 space-x-3">
                    <button @click="showModal = false" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Cancelar
                    </button>
                    <form action="{{ route('evento.destroy', $evento) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                            Sí, Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Mensajes de estado -->
            @if(session()->has('message'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ session('message') }}</span>
                </div>
            </div>
            @endif

            <!-- Tarjeta de información del evento -->
            <div class="overflow-hidden bg-white shadow rounded-xl">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Descripción del evento</h3>
                        <p class="mt-2 text-gray-600">{{ $evento->descripcion }}</p>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <!-- Detalles del evento -->
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Fechas</h4>
                                <div class="mt-1 space-y-1">
                                    <p class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-medium">Inicio:</span> {{ $evento->fecha_inicio->format('d/m/Y H:i') }}
                                    </p>
                                    <p class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-medium">Fin:</span> {{ $evento->fecha_fin->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Estado</h4>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                        @if($evento->estado == 'ACTIVO') bg-green-100 text-green-800
                                        @elseif($evento->estado == 'INACTIVO') bg-gray-100 text-gray-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $evento->estado }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Organizador y participantes -->
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Organizador</h4>
                                <div class="flex items-center mt-1">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-100">
                                            <span class="font-medium text-indigo-600">{{ substr($evento->creador->name, 0, 1) }}</span>
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $evento->creador->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $evento->creador->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Participación</h4>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $evento->participantes()->where('estado_participante', 'CONFIRMADO')->count() }} confirmados
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gestión de participación para usuarios no organizadores -->
                    @if(auth()->user()->id != $evento->user_id)
                        @if($participante != null)
                        <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">Mi participación</h3>
                            
                            <div class="mt-4 space-y-6">
                                <!-- Estado actual -->
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Estado actual</h4>
                                    <div class="mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                            @if($participante->estado_participante == 'CONFIRMADO') bg-green-100 text-green-800
                                            @elseif($participante->estado_participante == 'PENDIENTE') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $participante->estado_participante }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Formulario de actualización -->
                                <form action="{{ route('participante.update', $evento) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 mb-2">Cambiar estado</h4>
                                        <div class="flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3">
                                            <select name="estado_participante" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                <option value="CONFIRMADO" {{ $participante->estado_participante == 'CONFIRMADO' ? 'selected' : '' }}>Confirmado</option>
                                                <option value="PENDIENTE" {{ $participante->estado_participante == 'PENDIENTE' ? 'selected' : '' }}>Pendiente</option>
                                                <option value="RECHAZADO" {{ $participante->estado_participante == 'RECHAZADO' ? 'selected' : '' }}>Rechazado</option>
                                            </select>
                                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Actualizar
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Formulario para eliminar participación -->
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-2">¿Ya no puedes asistir?</h4>
                                    <form action="{{ route('participante.destroy', $evento) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('¿Estás seguro de abandonar este evento?')">
                                            Abandonar evento
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="mt-8 p-6 text-center bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">¿Te gustaría participar?</h3>
                            <p class="mt-2 text-gray-600">Confirma tu asistencia para que el organizador pueda contar contigo.</p>
                            <form action="{{ route('participante.store', $evento) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Confirmar asistencia
                                </button>
                            </form>
                        </div>
                        @endif
                    @endif

                    <!-- Lista de participantes (solo para organizadores) -->
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>