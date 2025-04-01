<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl px-6 py-4 shadow-md flex items-center gap-3">
            <div class="bg-white p-2 rounded-full">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6h13M9 5v6h13M5 5h.01M5 11h.01M5 17h.01" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">Reportes</h2>
                <p class="text-sm text-indigo-100">Visualiza los reportes generados y su estado</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl p-6">

                <div class="flex flex-col justify-between mb-6 space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                    @can('create', App\Models\Reporte::class)
                        <a href="{{ route('reporte.create') }}"
                            class="inline-block px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                            Crear Reporte
                        </a>
                    @endcan

                    <form method="GET" action="{{ route('reporte.index') }}" class="flex items-center space-x-2">
                        <x-input-label for="estado" :value="__('Filtrar por estado:')" class="hidden md:inline-block" />
                        <select id="estado" name="estado" onchange="this.form.submit()"
                            class="block w-full p-2 text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:w-48">
                            <option value="">Todos los reportes</option>
                            <option value="ACTIVO" {{ request('estado') == 'ACTIVO' ? 'selected' : '' }}>Activos</option>
                            <option value="INACTIVO" {{ request('estado') == 'INACTIVO' ? 'selected' : '' }}>Inactivos</option>
                            <option value="FINALIZADO" {{ request('estado') == 'FINALIZADO' ? 'selected' : '' }}>Finalizados</option>
                        </select>
                    </form>
                </div>

                @if (session()->has('message'))
                    <p class="my-4 font-bold text-center text-green-600">
                        {{ session('message') }}
                    </p>
                @endif

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($reportes as $reporte)
                        <div class="p-5 bg-white border border-gray-200 rounded-xl shadow hover:shadow-md transition">
                            <div class="mb-3">
                                <h3 class="text-lg font-semibold text-indigo-600">{{ $reporte->titulo }}</h3>
                                <p class="text-sm text-gray-500">{{ $reporte->descripcion }}</p>
                            </div>

                            <div class="text-sm text-gray-600 space-y-1">
                                <p><span class="font-medium">Fecha de Creación:</span> {{ $reporte->created_at->format('d/m/Y H:i') }}</p>
                                <p><span class="font-medium">Estado:</span>
                                    <span
                                        class="@if ($reporte->estado == 'ACTIVO') text-green-600 @elseif($reporte->estado == 'INACTIVO') text-gray-500 @else text-red-600 @endif">
                                        {{ $reporte->estado }}
                                    </span>
                                </p>
                                <p><span class="font-medium">Participantes:</span> {{ $reporte->participantes_count }}</p>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-4">
                                <a href="{{ route('reporte.show', $reporte) }}"
                                    class="px-3 py-1 text-xs font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                                    Ver Reporte
                                </a>

                                @can('update', $reporte)
                                    <a href="{{ route('reporte.edit', $reporte) }}"
                                        class="px-3 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded hover:bg-indigo-200">
                                        Editar
                                    </a>
                                    <form action="{{ route('reporte.destroy', $reporte) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('¿Estás seguro de eliminar este reporte?')"
                                            class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded hover:bg-red-200">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500">
                            No hay reportes para mostrar
                        </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $reportes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
