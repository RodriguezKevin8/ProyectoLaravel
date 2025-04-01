<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl px-6 py-4 shadow-md flex items-center gap-3">
            <div class="bg-white p-2 rounded-full">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">Crear Evento</h2>
                <p class="text-sm text-indigo-100">Organiza un nuevo evento para los participantes</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Contenedor con fondo morado limitado -->
            <div class="rounded-2xl shadow-lg bg-gradient-to-br from-indigo-500 to-purple-600 p-1">
                <!-- Tarjeta blanca encima del degradado -->
                <div class="bg-white rounded-xl p-8">
                    <form action="{{ route('evento.store') }}" method="POST" class="space-y-6" novalidate>
                        @csrf

                        <!-- Título -->
                        <div>
                            <x-input-label for="titulo" :value="__('Título del Evento')" />
                            <x-text-input id="titulo" class="block w-full mt-1" type="text" name="titulo" placeholder="Ej. Fiesta de Bienvenida" required />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <!-- Descripción -->
                        <div>
                            <x-input-label for="descripcion" :value="__('Descripción')" />
                            <textarea id="descripcion" name="descripcion" rows="4"
                                      class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Describe el objetivo del evento, lugar, detalles importantes..." required></textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <!-- Fecha de inicio -->
                        <div>
                            <x-input-label for="fecha_inicio" :value="__('Fecha de inicio')" />
                            <x-text-input id="fecha_inicio" class="block w-full mt-1" type="date" name="fecha_inicio" required />
                            <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                        </div>

                        <!-- Fecha final -->
                        <div>
                            <x-input-label for="fecha_fin" :value="__('Fecha final')" />
                            <x-text-input id="fecha_fin" class="block w-full mt-1" type="date" name="fecha_fin" required />
                            <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                        </div>

                        <!-- Botón -->
                        <div class="pt-4">
                            <button type="submit"
                                    class="w-full flex justify-center items-center gap-2 py-3 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Crear Evento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
