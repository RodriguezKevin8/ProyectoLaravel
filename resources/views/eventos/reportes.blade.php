<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl px-6 py-4 shadow-md flex items-center gap-3">
            <div class="bg-white p-2 rounded-full">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a4 4 0 118 0v2m-6 4h.01M6 12h.01M6 16h.01M6 20h.01" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">Reportes Gráficos</h2>
                <p class="text-sm text-indigo-100">Visualiza la actividad y participación en los eventos</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto space-y-10 px-4 sm:px-6 lg:px-8">

            <!-- Gráfico 1 -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a4 4 0 118 0v2m-6 4h.01M6 12h.01M6 16h.01M6 20h.01" />
                    </svg>
                    Estado de los Eventos
                </h3>
                <canvas id="estadoEventosChart" height="200"></canvas>
            </div>

            <!-- Gráfico 2 -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13v6m0 4H6a2 2 0 01-2-2v-6a2 2 0 012-2h4" />
                    </svg>
                    Eventos con más participación
                </h3>
                <canvas id="eventosParticipadosChart" height="200"></canvas>
            </div>

            <!-- Gráfico 3 -->
            <div class="bg-white shadow-lg rounded-2xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Eventos creados por mes
                </h3>
                <canvas id="eventosPorMesChart" height="200"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gráfico 1
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
                options: { responsive: true }
            });

            // Gráfico 2
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
                        y: { beginAtZero: true }
                    }
                }
            });

            // Gráfico 3
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
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
