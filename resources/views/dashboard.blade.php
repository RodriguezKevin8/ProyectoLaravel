<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(auth()->user()->isAdmin)
                <!-- Mensaje cuando no hay datos -->
                @if(!$mostrarGraficos)
                    <div class="p-4 mb-6 text-center bg-blue-100 border-l-4 border-blue-500 text-blue-700 rounded-lg">
                        <div class="flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="font-medium">
                                @if(isset($mensaje))
                                    {{ $mensaje }}
                                @else
                                    No hay datos disponibles para mostrar los gráficos.
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('evento.create') }}" class="inline-flex items-center px-4 py-2 mt-3 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Crear primer evento
                        </a>
                    </div>
                @endif

                <!-- Sección de gráficos (solo si hay datos) -->
                @if($mostrarGraficos)
                    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
                        <!-- Gráfico 1: Estado de Eventos -->
                        <div class="p-4 bg-white rounded-lg shadow">
                            <h3 class="mb-3 text-lg font-medium">Estado de los Eventos</h3>
                            <canvas id="estadoEventosChart" height="200"></canvas>
                        </div>
                        
                        <!-- Gráfico 2: Eventos más participados -->
                        <div class="p-4 bg-white rounded-lg shadow">
                            <h3 class="mb-3 text-lg font-medium">Eventos más participados</h3>
                            <canvas id="eventosParticipadosChart" height="200"></canvas>
                        </div>
                        
                        <!-- Gráfico 3: Eventos por mes -->
                        <div class="p-4 bg-white rounded-lg shadow md:col-span-2">
                            <h3 class="mb-3 text-lg font-medium">Eventos creados por mes</h3>
                            <canvas id="eventosPorMesChart" height="200"></canvas>
                        </div>
                    </div>
                @endif
            @endif

            <!-- Resto del contenido normal del dashboard -->
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("¡Bienvenido!") }}
                    @if(!auth()->user()->isAdmin)
                        <p class="mt-2 text-sm text-gray-600">Actualmente no tienes acceso a los reportes de administrador.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->isAdmin && $mostrarGraficos)
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gráfico 1: Estado de Eventos
                if (document.getElementById('estadoEventosChart')) {
                    new Chart(document.getElementById('estadoEventosChart'), {
                        type: 'pie',
                        data: {
                            labels: {!! json_encode(array_keys($estadosEventos ?? [])) !!},
                            datasets: [{
                                data: {!! json_encode(array_values($estadosEventos ?? [])) !!},
                                backgroundColor: [
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(255, 99, 132, 0.7)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.label}: ${context.raw} eventos`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                // Gráfico 2: Eventos más participados
                if (document.getElementById('eventosParticipadosChart')) {
                    new Chart(document.getElementById('eventosParticipadosChart'), {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($eventosMasParticipados['titulos'] ?? []) !!},
                            datasets: [{
                                label: 'Participantes confirmados',
                                data: {!! json_encode($eventosMasParticipados['participantes'] ?? []) !!},
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return Number.isInteger(value) ? value : '';
                                        }
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.dataset.label}: ${context.raw}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                // Gráfico 3: Eventos por mes
                if (document.getElementById('eventosPorMesChart')) {
                    new Chart(document.getElementById('eventosPorMesChart'), {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($eventosPorMes['meses'] ?? []) !!},
                            datasets: [{
                                label: 'Eventos creados',
                                data: {!! json_encode($eventosPorMes['datos'] ?? []) !!},
                                borderColor: 'rgba(153, 102, 255, 0.7)',
                                backgroundColor: 'rgba(153, 102, 255, 0.1)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `${context.dataset.label}: ${context.raw}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
        @endpush
    @endif
</x-app-layout>