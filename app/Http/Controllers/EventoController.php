<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $query = Evento::query();
        if (!auth()->user()->isAdmin) {
            $query->where('estado', 'ACTIVO');
        }
        $estadosValidos = ['ACTIVO', 'INACTIVO', 'FINALIZADO'];
        if ($request->has('estado') && in_array($request->estado, $estadosValidos)) {
            $query->where('estado', $request->estado);
        }
        $eventos = $query->orderBy('fecha_inicio', 'desc')->paginate(6);
        
        return view('eventos.index', [
            'eventos' => $eventos,
        ]);
    }

   public function create() {
    Gate::authorize('viewAny', Evento::class);
    return view('eventos.create');
   }

   public function store(Request $request) {
    $evento = $request->validate([
        'titulo' =>'required|string|max:255',
        'descripcion' =>'required|string|max:255',
        'fecha_inicio' =>'required|date',
        'fecha_fin' =>'required|date',
    ]);

    Evento::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_fin' => $request->fecha_fin,
        'estado' => 'ACTIVO',
        'user_id' => auth()->user()->id,
    ]);

    return redirect()->route('evento.index')->with('message', 'El evento fue creado correctamente');
   }
   public function show(Evento $evento){
    $participante = Participante::where('user_id', auth()->user()->id)->where('evento_id', $evento->id)->first();
    
    return view('eventos.show', [
        'evento' => $evento,
        'participante' => $participante
    ]);
   }
   
   public function edit(Evento $evento){
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

    return redirect()->route('evento.index')->with('message', 'Evento actualizado correctamente');
}

   public function destroy(Evento $evento){
    Gate::authorize('viewAny', Evento::class);
        $evento->delete();
        return redirect()->route('evento.index')->with('message', 'El evento fue eliminado correctamente');
   }
}
