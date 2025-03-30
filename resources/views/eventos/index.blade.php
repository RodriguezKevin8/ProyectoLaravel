<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                        @can('create', App\Models\Evento::class)
                        <a href="{{route('evento.create')}}" class="p-2 text-sm font-bold transition-colors rounded bg-lime-300 hover:bg-lime-400 text-slate-700">
                            Crear Evento
                        </a>
                        @endcan
                        
                        <form method="GET" action="{{ route('evento.index') }}" class="flex items-center space-x-2">
                            <x-input-label for="estado" :value="__('Filtrar por estado:')" class="hidden md:inline-block" />
                            <select 
                                id="estado" 
                                name="estado" 
                                onchange="this.form.submit()"
                                class="block w-full p-2 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:w-48"
                            >
                                <option value="">Todos los eventos</option>
                                <option value="ACTIVO" {{ request('estado') == 'ACTIVO' ? 'selected' : '' }}>Activos</option>
                                <option value="INACTIVO" {{ request('estado') == 'INACTIVO' ? 'selected' : '' }}>Inactivos</option>
                                <option value="FINALIZADO" {{ request('estado') == 'FINALIZADO' ? 'selected' : '' }}>Finalizados</option>
                            </select>
                        </form>
                    </div>
                    
                    @if(session()->has('message'))
                        <p class="my-4 font-bold text-center text-green-500">
                            {{session('message')}}
                        </p>
                    @endif

                    {{-- listar los eventos --}}
                    <div class="grid grid-cols-1 gap-2 my-4 md:grid-cols-4 sm:grid-cols-2">
                        @forelse ($eventos as $evento)
                            <div class="p-4 bg-white rounded-md shadow-lg">
                                <div class="text-lg font-bold text-gray-800">{{$evento->titulo}}</div>
                                <p class="mt-1 text-sm text-gray-600">{{$evento->descripcion}}</p>
                                <div class="mt-2 text-xs text-gray-500">
                                    <p><span class="font-semibold">Inicio:</span> {{$evento->fecha_inicio->format('d/m/Y H:i')}}</p>
                                    <p><span class="font-semibold">Fin:</span> {{$evento->fecha_fin->format('d/m/Y H:i')}}</p>
                                    <p><span class="font-semibold">Estado:</span> 
                                        <span class="@if($evento->estado == 'ACTIVO') text-green-600 
                                                    @elseif($evento->estado == 'INACTIVO') text-gray-600 
                                                    @else text-red-600 @endif">
                                            {{$evento->estado}}
                                        </span>
                                    </p>
                                </div>
                                
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <!-- Botón "Ver Evento" para todos los usuarios -->
                                    <a href="{{route('evento.show', $evento)}}" class="px-2 py-1 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                                        Ver Evento
                                    </a>
                                    
                                    <!-- Botones administrativos solo para admins -->
                                    @can('update', $evento)
                                    <a href="{{route('evento.edit', $evento)}}" class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded hover:bg-blue-200">
                                        Editar
                                    </a>
                                    <form action="{{route('evento.destroy', $evento)}}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded hover:bg-red-200" onclick="return confirm('¿Estás seguro de eliminar este evento?')">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endcan
                                    
                                    @can('manageParticipants', $evento)
                                    <a href="{{route('participante.create', ['evento_id' => $evento->id])}}" class="px-2 py-1 text-xs font-medium text-purple-800 bg-purple-100 rounded hover:bg-purple-200">
                                        Agregar Participante
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <p class="text-center text-gray-500">No hay eventos para mostrar</p>
                            </div>
                        @endforelse
                    </div>
                    
                    {{$eventos->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>