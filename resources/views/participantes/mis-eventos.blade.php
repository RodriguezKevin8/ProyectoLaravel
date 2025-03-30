<x-app-layout>
    <x-slot name="content">
        <div class="container py-4">
            <h2 class="mb-4">Mis Eventos Inscritos</h2>
            
            @if($participaciones->isEmpty())
                <div class="alert alert-warning">
                    No estás inscrito en ningún evento.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Participación</th>
                                <th>Evento</th>
                                <th>Organizador</th>
                                <th>Estado</th>
                                <th>Fecha Inscripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participaciones as $participacion)
                                <tr>
                                    <td>{{ $participacion->id }}</td>
                                    <td>
                                        @if($participacion->evento)
                                            <strong>{{ $participacion->evento->titulo }}</strong><br>
                                            <small>{{ $participacion->evento->descripcion }}</small>
                                        @else
                                            <span class="text-danger">Evento eliminado</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($participacion->evento && $participacion->evento->creador)
                                            {{ $participacion->evento->creador->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $participacion->estado_participante == 'CONFIRMADO' ? 'success' : 'warning' }}">
                                            {{ $participacion->estado_participante }}
                                        </span>
                                    </td>
                                    <td>{{ $participacion->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </x-slot>
</x-app-layout>