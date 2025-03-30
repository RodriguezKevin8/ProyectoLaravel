<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Participantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                        @can('create', App\Models\Participante::class)
                        <a href="{{ route('participante.create') }}" class="p-2 text-sm font-bold transition-colors rounded bg-lime-300 hover:bg-lime-400 text-slate-700">
                            Registrar Participante
                        </a>
                        @endcan
                        
                        <form method="GET" action="{{ route('participante.index') }}" class="flex items-center space-x-2">
                            <x-input-label for="estado" :value="__('Filtrar por estado:')" class="hidden md:inline-block" />
                            <select 
                                id="estado" 
                                name="estado" 
                                onchange="this.form.submit()"
                                class="block w-full p-2 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:w-48"
                            >
                                <option value="">Todos los estados</option>
                                <option value="CONFIRMADO" {{ request('estado') == 'CONFIRMADO' ? 'selected' : '' }}>Confirmados</option>
                                <option value="PENDIENTE" {{ request('estado') == 'PENDIENTE' ? 'selected' : '' }}>Pendientes</option>
                                <option value="CANCELADO" {{ request('estado') == 'CANCELADO' ? 'selected' : '' }}>Cancelados</option>
                            </select>
                        </form>
                    </div>
                    
                    @if(session()->has('message'))
                        <p class="my-4 font-bold text-center text-green-500">
                            {{ session('message') }}
                        </p>
                    @endif

                    {{-- Listado de participantes --}}
                    <div class="grid grid-cols-1 gap-4 my-4 md:grid-cols-3">
                        @forelse ($participantes as $participante)
                            <div class="p-4 bg-white rounded-md shadow-lg">
                                <div class="flex items-center justify-between">
                                    <div class="text-lg font-bold text-gray-800">
                                        {{ $participante->usuario->name ?? 'Usuario no disponible' }}
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded 
                                        @if($participante->estado_participante == 'CONFIRMADO') bg-green-100 text-green-800
                                        @elseif($participante->estado_participante == 'PENDIENTE') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $participante->estado_participante }}
                                    </span>
                                </div>
                                
                                <div class="mt-2 text-sm text-gray-600">
                                    <p><span class="font-semibold">Evento:</span> {{ $participante->evento->titulo ?? 'Evento no disponible' }}</p>
                                    <p><span class="font-semibold">Fecha inscripción:</span> {{ $participante->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                
                                <div class="flex flex-wrap gap-2 mt-3">
                                    @can('update', $participante)
                                    <a href="{{ route('participante.edit', $participante) }}" class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded hover:bg-blue-200">
                                        Editar
                                    </a>
                                    @endcan
                                    
                                    @can('delete', $participante)
                                    <form action="{{ route('participante.destroy', $participante) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded hover:bg-red-200" onclick="return confirm('¿Estás seguro de eliminar esta participación?')">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                <a href="{{route('evento.show',$participante->evento->id )}}" class="px-2 py-1 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                                        Ver Evento
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <p class="text-center text-gray-500">No hay participantes registrados</p>
                            </div>
                        @endforelse
                    </div>
                    
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>