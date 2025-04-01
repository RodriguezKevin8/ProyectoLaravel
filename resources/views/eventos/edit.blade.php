<x-app-layout>
<x-slot name="header">
    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl px-6 py-4 flex items-center gap-4 shadow-md">
        <div class="bg-white p-2 rounded-full">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-white">
                Editar Evento
            </h2>
            <p class="text-sm text-indigo-100">Modifica la información de: <strong>{{ $evento->titulo }}</strong></p>
        </div>
    </div>
</x-slot>


    <div class="py-12 bg-gray-100">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <!-- Lado izquierdo visual -->
            <div class="hidden md:flex w-full md:w-2/5 bg-gradient-to-br from-indigo-500 to-purple-600 items-center justify-center p-10">
                <div class="text-center text-white">
                    <h2 class="text-3xl font-bold mb-2">Edita tu evento</h2>
                    <p class="text-lg">Actualiza los datos para mantenerlo al día</p>
                    <img src="https://cdn-icons-png.flaticon.com/512/1827/1827392.png" alt="Editar evento" class="w-32 mx-auto mt-6">
                </div>
            </div>

            <!-- Formulario -->
            <div class="w-full md:w-3/5 p-8 sm:p-12">
                <h2 class="text-xl font-semibold text-gray-700 mb-6 text-center">Formulario de Edición</h2>

                <form action="{{ route('evento.update', $evento) }}" method="POST" class="space-y-6" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div>
                        <x-input-label for="titulo" :value="__('Título del evento')" />
                        <x-text-input 
                            id="titulo" 
                            class="block w-full mt-1" 
                            type="text" 
                            name="titulo" 
                            required 
                            value="{{ old('titulo', $evento->titulo) }}"
                            placeholder="Ej. Conferencia de tecnología 2025" />
                        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                    </div>

                    <!-- Descripción -->
                    <div>
                        <x-input-label for="descripcion" :value="__('Descripción')" />
                        <textarea 
                            id="descripcion" 
                            name="descripcion" 
                            rows="4"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Escribe aquí una breve descripción del evento..."
                            required>{{ old('descripcion', $evento->descripcion) }}</textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <!-- Fecha de inicio -->
                    <div>
                        <x-input-label for="fecha_inicio" :value="__('Fecha de inicio')" />
                        <x-text-input 
                            id="fecha_inicio" 
                            class="block w-full mt-1" 
                            type="datetime-local" 
                            name="fecha_inicio" 
                            required 
                            value="{{ old('fecha_inicio', $evento->fecha_inicio->format('Y-m-d\TH:i')) }}" />
                        <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                    </div>

                    <!-- Fecha final -->
                    <div>
                        <x-input-label for="fecha_fin" :value="__('Fecha de finalización')" />
                        <x-text-input 
                            id="fecha_fin" 
                            class="block w-full mt-1" 
                            type="datetime-local" 
                            name="fecha_fin" 
                            required 
                            value="{{ old('fecha_fin', $evento->fecha_fin->format('Y-m-d\TH:i')) }}" />
                        <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                    </div>

                    <!-- Estado (si tiene permiso) -->
                    @can('update', $evento)
                        <div>
                            <x-input-label for="estado" :value="__('Estado del evento')" />
                            <select 
                                id="estado" 
                                name="estado" 
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="ACTIVO" {{ old('estado', $evento->estado) == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                                <option value="INACTIVO" {{ old('estado', $evento->estado) == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                                <option value="FINALIZADO" {{ old('estado', $evento->estado) == 'FINALIZADO' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                        </div>
                    @endcan

                    <!-- Botón -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center gap-2 py-3 text-white font-semibold bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Actualizar Evento') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
