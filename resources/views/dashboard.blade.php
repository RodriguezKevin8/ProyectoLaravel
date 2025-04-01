<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(auth()->user()->isAdmin)
                @if(!$mostrarGraficos && isset($mensaje))
                    <div class="p-4 mb-6 text-center bg-blue-100 border-l-4 border-blue-500 text-blue-700 rounded-lg">
                        <!-- Mensaje cuando no hay datos -->
                        {{ $mensaje }}
                    </div>
                @endif

                @if($mostrarGraficos)
                    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
                        <!-- Gráfico 1: Estado de Eventos -->
                        <div class="p-4 bg-white rounded-lg shadow">
                            <h3 class="mb-3 text-lg font-medium">Estado de los Eventos</h3>
                            <x-chartjs-component :chart="$chartEstados" />
                        </div>
                        
                        <!-- Gráfico 2: Eventos más participados -->
                        <div class="p-4 bg-white rounded-lg shadow">
                            <h3 class="mb-3 text-lg font-medium">Eventos más participados</h3>
                            <x-chartjs-component :chart="$chartParticipados" />
                        </div>
                        
                        <!-- Gráfico 3: Eventos por mes -->
                        <div class="p-4 bg-white rounded-lg shadow md:col-span-2">
                            <h3 class="mb-3 text-lg font-medium">Eventos creados por mes</h3>
                            <x-chartjs-component :chart="$chartMensual" />
                        </div>
                    </div>
                @endif
            @endif

            <!-- Resto del contenido -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("¡Bienvenido!") }}
                    @if(!auth()->user()->isAdmin)
                        <p class="mt-2 text-sm text-gray-600">No tienes acceso a los reportes.</p>
                    @else
                        <p class="mt-2 text-sm text-gray-600">Total de eventos: {{ $totalEventos }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->isAdmin && $mostrarGraficos)
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @endpush
    @endif
</x-app-layout>