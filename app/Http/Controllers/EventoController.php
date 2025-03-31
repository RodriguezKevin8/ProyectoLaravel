<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventoCreadoMail;
use App\Mail\ActualizacionMail;
use App\Models\User; 

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $query = Evento::query();

        if ($request->has('estado') && strlen($request['estado']) != 0):
            $query->where('estado', $request->estado);
        endif;
        $eventos = $query->orderBy('fecha_inicio', 'desc')->paginate(6);

        return view('eventos.index', [
            'eventos' => $eventos,
        ]);
    }

    public function create()
    {
        Gate::authorize('viewAny', Evento::class);
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $evento = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
        ]);

       $nuevoe =  Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => 'ACTIVO',
            'user_id' => auth()->user()->id,
        ]);
        $usuarios = User::all();
        foreach ($usuarios as $usuario) {
            Mail::to($usuario->email)->send(new EventoCreadoMail($nuevoe));
        }

        return redirect()->route('evento.index')->with('message', 'El evento fue creado correctamente');
    }
    public function show(Evento $evento)
    {
        $participante = Participante::where('user_id', auth()->user()->id)->where('evento_id', $evento->id)->first();
        return view('eventos.show', [
            'evento' => $evento,
            'participante' => $participante
        ]);
    }

    public function edit(Evento $evento)
    {
        Gate::authorize('viewAny', Evento::class);
        return view('eventos.edit', [
            'evento' => $evento,
        ]);
    }

    public function update(Request $request, Evento $evento)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'estado' => 'required|in:ACTIVO,INACTIVO,FINALIZADO',
        ]);

        $evento->update($validated);
        $usuarios = User::all();
        foreach ($usuarios as $usuario) {
            Mail::to($usuario->email)->send(new ActualizacionMail($evento));
        }

        return redirect()->route('evento.index')->with('message', 'Evento actualizado correctamente');
    }

    public function destroy(Evento $evento)
    {
        Gate::authorize('viewAny', Evento::class);
        $evento->delete();
        return redirect()->route('evento.index')->with('message', 'El evento fue eliminado correctamente');
    }
    public function reporteEventos()
    {
        $eventos = Evento::withCount('participantes')  // Usamos withCount para obtener el número de participantes
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('reportes.eventos', compact('eventos'));
    }

    // Reporte de Participación
    public function reporteParticipacion()
    {
        $participantes = Participante::with('user', 'evento')  // Eager loading para traer datos de usuarios y eventos
                                 ->get();

        return view('reportes.participacion', compact('participantes'));
    }
}
