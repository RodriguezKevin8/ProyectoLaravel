@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-100">
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-2xl p-8">
                <h1 class="text-2xl font-bold text-indigo-600 mb-6 text-center">📊 Reporte de Eventos</h1>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700">
                        <thead class="bg-indigo-600 text-white">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Título</th>
                                <th class="px-6 py-3 font-semibold">Fecha de Inicio</th>
                                <th class="px-6 py-3 font-semibold">Estado</th>
                                <th class="px-6 py-3 font-semibold">Participantes</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($eventos as $evento)
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-6 py-4">{{ $evento->titulo }}</td>
                                    <td class="px-6 py-4">{{ $evento->fecha_inicio }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium
                                            {{ $evento->estado === 'activo' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ ucfirst($evento->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">{{ $evento->participantes_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if(count($eventos) === 0)
                    <p class="mt-6 text-center text-gray-500">No hay eventos registrados aún.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
