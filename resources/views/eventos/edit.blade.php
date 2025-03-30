<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar Evento: '. $evento->titulo) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{route('evento.update', $evento)}}" method="POST" class="flex flex-col items-center" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <!-- Campo Título -->
                        <div class="w-full max-w-xl mt-4">
                            <x-input-label for="titulo" :value="__('Título')" />
                            <x-text-input id="titulo" class="block w-full mt-1"
                                          type="text"
                                          name="titulo"
                                          required autocomplete="titulo"
                                          value="{{old('titulo', $evento->titulo)}}" />
                            <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                        </div>

                        <!-- Campo Descripción -->
                        <div class="w-full max-w-xl mt-4">
                            <x-input-label for="descripcion" :value="__('Descripción')" />
                            <textarea id="descripcion" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                      name="descripcion"
                                      required autocomplete="descripcion">{{old('descripcion', $evento->descripcion)}}</textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>

                        <!-- Campos de Fecha -->
                        <div class="w-full max-w-xl mt-4">
                            <x-input-label for="fecha_inicio" :value="__('Fecha de inicio')" />
                            <x-text-input id="fecha_inicio" class="block w-full mt-1"
                                          type="datetime-local"
                                          name="fecha_inicio"
                                          required autocomplete="fecha_inicio"
                                          value="{{ old('fecha_inicio', $evento->fecha_inicio->format('Y-m-d\TH:i')) }}" />
                            <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                        </div>

                        <div class="w-full max-w-xl mt-4">
                            <x-input-label for="fecha_fin" :value="__('Fecha final')" />
                            <x-text-input id="fecha_fin" class="block w-full mt-1"
                                          type="datetime-local"
                                          name="fecha_fin"
                                          value="{{ old('fecha_fin', $evento->fecha_fin->format('Y-m-d\TH:i')) }}"
                                          required autocomplete="fecha_fin" />
                            <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                        </div>

                        <!-- Campo Estado (solo para administradores) -->
                        @can('update', $evento)
                        <div class="w-full max-w-xl mt-4">
                            <x-input-label for="estado" :value="__('Estado')" />
                            <select id="estado" name="estado" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="ACTIVO" {{ old('estado', $evento->estado) == 'ACTIVO' ? 'selected' : '' }}>Activo</option>
                                <option value="INACTIVO" {{ old('estado', $evento->estado) == 'INACTIVO' ? 'selected' : '' }}>Inactivo</option>
                                <option value="FINALIZADO" {{ old('estado', $evento->estado) == 'FINALIZADO' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                        </div>
                        @endcan

                        <!-- Botón de envío -->
                        <button type="submit" class="w-full max-w-xl p-2 mt-4 text-sm font-bold transition-colors rounded bg-lime-300 hover:bg-lime-400 text-slate-700">
                            Actualizar Evento
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>