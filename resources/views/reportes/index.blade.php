<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Reportes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                        <!-- Botón para crear un nuevo reporte -->
                        @can('create', App\Models\Reporte::class)
                        <a href="{{route('reporte.create')}}" class="p-2 text-sm font-bold transition-colors rounded bg-lime-300 hover:bg-lime-400 text-slate-700">
                            Crear Reporte
                        </a>
                        @endcan

                        <!-- Filtro para seleccionar el estado del reporte -->
                        <form method="GET" action="{{ route('reporte.index') }}" class="flex items-center space-x-2">
                            <x-input-label for="estado" :value="__('Filtrar por estado:')" class="hidden md:inline-block" />
                            <select 
                                id="estado" 
                                name="estado" 
                                onchange="this.form.submit()"
                                class="block w-full p-2 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:w-48"
                            >
                                <option value="">Todos los reportes</option>
                                <option value="ACTIVO" {{ request('estado') == 'ACTIVO' ? 'selected' : '' }}>Activos</option>
                                <option value="INACTIVO" {{ request('estado') == 'INACTIVO' ? 'selected' : '' }}>Inactivos</option>
                                <option value="FINALIZADO" {{ request('estado') == 'FINALIZADO' ? 'selected' : '' }}>Finalizados</option>
                            </select>
                        </form>
                    </div>
                    
                    <!-- Mensaje de éxito -->
                    @if(session()->has('message'))
                        <p class="my-4 font-bold text-center text-green-500">
                            {{ session('message') }}
                        </p>
                    @endif

                    <!-- Lista de reportes -->
                    <div class="grid grid-cols-1 gap-2 my-4 md:grid-cols-4 sm:grid-cols-2">
                        @forelse ($reportes as $reporte)
                            <div class="p-4 bg-white rounded-md shadow-lg">
                                <div class="text-lg font-bold text-gray-800">{{ $reporte->titulo }}</div>
                                <p class="mt-1 text-sm text-gray-600">{{ $reporte->descripcion }}</p>
                                <div class="mt-2 text-xs text-gray-500">
                                    <p><span class="font-semibold">Fecha de Creación:</span> {{ $reporte->created_at->format('d/m/Y H:i') }}</p>
                                    <p><span class="font-semibold">Estado:</span> 
                                        <span class="@if($reporte->estado == 'ACTIVO') text-green-600 
                                                    @elseif($reporte->estado == 'INACTIVO') text-gray-600 
                                                    @else text-red-600 @endif">
                                            {{ $reporte->estado }}
                                        </span>
                                    </p>
                                    <p><span class="font-semibold">Número de Participantes:</span> {{ $reporte->participantes_count }}</p>
                                </div>
                                
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <!-- Botón para ver el reporte -->
                                    <a href="{{ route('reporte.show', $reporte) }}" class="px-2 py-1 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                                        Ver Reporte
                                    </a>
                                    
                                    <!-- Botones administrativos solo para admins -->
                                    @can('update', $reporte)
                                    <a href="{{ route('reporte.edit', $reporte) }}" class="px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded hover:bg-blue-200">
                                        Editar
                                    </a>
                                    <form action="{{ route('reporte.destroy', $reporte) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded hover:bg-red-200" onclick="return confirm('¿Estás seguro de eliminar este reporte?')">
                                            Eliminar
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <p class="text-center text-gray-500">No hay reportes para mostrar</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <!-- Paginación -->
                    {{ $reportes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
