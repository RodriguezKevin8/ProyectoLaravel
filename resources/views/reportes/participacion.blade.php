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
                <h2 class="text-xl sm:text-2xl font-bold text-white">Reporte de Participación</h2>
                <p class="text-sm text-indigo-100">Mira el estado de participación por evento y usuario</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-2xl p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-xl overflow-hidden">
                        <thead class="text-xs text-white uppercase bg-indigo-600">
                            <tr>
                                <th scope="col" class="px-6 py-3">Usuario</th>
                                <th scope="col" class="px-6 py-3">Evento</th>
                                <th scope="col" class="px-6 py-3">Estado de Participación</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($participantes as $participante)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $participante->user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $participante->evento->titulo }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="@if($participante->estado === 'CONFIRMADO') text-green-600 font-semibold @elseif($participante->estado === 'PENDIENTE') text-yellow-600 font-semibold @else text-red-600 font-semibold @endif">
                                            {{ $participante->estado }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        No hay datos de participación para mostrar
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
