<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Reportes Gráficos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Gráfico 1: Estado de Eventos -->
                    <div class="mb-8">
                        <h3 class="mb-4 text-lg font-medium">Estado de los Eventos</h3>
                        <canvas id="estadoEventosChart" height="200"></canvas>
                    </div>

                    <!-- Gráfico 2: Eventos más participados -->
                    <div class="mb-8">
                        <h3 class="mb-4 text-lg font-medium">Eventos con más participación</h3>
                        <canvas id="eventosParticipadosChart" height="200"></canvas>
                    </div>

                    <!-- Gráfico 3: Eventos por mes -->
                    <div class="mb-8">
                        <h3 class="mb-4 text-lg font-medium">Eventos creados por mes</h3>
                        <canvas id="eventosPorMesChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gráfico 1: Estado de Eventos
            new Chart(document.getElementById('estadoEventosChart'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode(array_keys($estadosEventos)) !!},
                    datasets: [{
                        data: {!! json_encode(array_values($estadosEventos)) !!},
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(255, 99, 132, 0.7)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });

            // Gráfico 2: Eventos más participados
            new Chart(document.getElementById('eventosParticipadosChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($eventosMasParticipados->pluck('titulo')) !!},
                    datasets: [{
                        label: 'Participantes confirmados',
                        data: {!! json_encode($eventosMasParticipados->pluck('participantes_count')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfico 3: Eventos por mes
            const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            const eventosPorMesData = Array(12).fill(0);
            
            @foreach($eventosPorMes as $eventoMes)
                eventosPorMesData[{{ $eventoMes->mes }} - 1] = {{ $eventoMes->total }};
            @endforeach

            new Chart(document.getElementById('eventosPorMesChart'), {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Eventos creados',
                        data: eventosPorMesData,
                        borderColor: 'rgba(153, 102, 255, 0.7)',
                        backgroundColor: 'rgba(153, 102, 255, 0.1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>