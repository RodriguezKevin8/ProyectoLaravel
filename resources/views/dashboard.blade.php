<x-app-layout>
<x-slot name="header">
    @if(auth()->user()->isAdmin)
        <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl px-6 py-4 shadow-md flex items-center gap-3">
            <div class="bg-white p-2 rounded-full">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 8 4-16 3 8h4" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">Panel de Control</h2>
                <p class="text-sm text-indigo-100">Visualiza los reportes y el estado de tus eventos</p>
            </div>
        </div>
    @else
        <div class="bg-gradient-to-br from-green-500 to-teal-500 rounded-xl px-6 py-4 shadow-md flex items-center gap-3">
            <div class="bg-white p-2 rounded-full">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-white">¡Bienvenido de nuevo!</h2>
                <p class="text-sm text-green-100">Explora y participa en eventos únicos creados para ti</p>
            </div>
        </div>
    @endif
</x-slot>





    <div class="py-10">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            @if(auth()->user()->isAdmin)
                @if(!$mostrarGraficos && isset($mensaje))
                    <div class="p-4 mb-6 text-center bg-blue-50 border border-blue-300 text-blue-700 rounded-md">
                        {{ $mensaje }}
                    </div>
                @endif

                @if($mostrarGraficos)
                    <div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-2">
                        <!-- Gráfico 1 -->
                        <div class="bg-white p-4 rounded-md shadow-sm border">
                            <h3 class="text-base font-semibold text-gray-700 mb-3">Estado de los Eventos</h3>
                            <x-chartjs-component :chart="$chartEstados" />
                        </div>

                        <!-- Gráfico 2 -->
                        <div class="bg-white p-4 rounded-md shadow-sm border">
                            <h3 class="text-base font-semibold text-gray-700 mb-3">Eventos más participados</h3>
                            <x-chartjs-component :chart="$chartParticipados" />
                        </div>

                        <!-- Gráfico 3 -->
                        <div class="bg-white p-4 rounded-md shadow-sm border md:col-span-2">
                            <h3 class="text-base font-semibold text-gray-700 mb-3">Eventos creados por mes</h3>
                            <x-chartjs-component :chart="$chartMensual" />
                        </div>
                    </div>
                @endif
            @endif

            <!-- Bienvenida -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-md border">
    <div class="p-6 text-gray-900">
        {{ __("¡Bienvenido!") }}
        @if(!auth()->user()->isAdmin)
            <p class="mt-2 text-sm text-gray-600">
                Gracias por formar parte de nuestra comunidad. Explora los eventos disponibles y participa en los que más te gusten.
            </p>
        @else
            <p class="mt-2 text-sm text-gray-600">
                Total de eventos: <span class="font-medium text-blue-600">{{ $totalEventos }}</span>
            </p>
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
