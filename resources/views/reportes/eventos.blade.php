<!-- resources/views/reportes/eventos.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Reporte de Eventos</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Fecha de Inicio</th>
                <th>Estado</th>
                <th>Número de Participantes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventos as $evento)
                <tr>
                    <td>{{ $evento->titulo }}</td>
                    <td>{{ $evento->fecha_inicio }}</td>
                    <td>{{ $evento->estado }}</td>
                    <td>{{ $evento->participantes_count }}</td>  <!-- Muestra el número de participantes -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
