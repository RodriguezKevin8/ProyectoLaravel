<!-- resources/views/reportes/participacion.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Reporte de Participación</h1>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Evento</th>
                <th>Estado de Participación</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participantes as $participante)
                <tr>
                    <td>{{ $participante->user->name }}</td>
                    <td>{{ $participante->evento->titulo }}</td>
                    <td>{{ $participante->estado }}</td>  <!-- Muestra el estado de participación -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
