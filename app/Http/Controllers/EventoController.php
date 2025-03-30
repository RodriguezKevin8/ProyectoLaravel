<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventoController extends Controller
{
   public function index() {
    $eventos = Evento::where('user_id', auth()->user()->id)->paginate(6);
    return view('eventos.index', [
        'eventos' => $eventos,
    ]);
   }

   public function create() {
    Gate::authorize('viewAny');
    return view('eventos.create');
   }

   public function store(Request $request) {
    $evento = $request->validate([
        'titulo' =>'required|string|max:255',
        'descripcion' =>'required|string|max:255',
        'fecha_inicio' =>'required|date',
        'fecha_fin' =>'required|date',
    ]);

    //crear el evento dentro de la db
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
    Gate::authorize('viewAny');
    return view('eventos.edit', [
        'evento' => $evento,
    ]);
   }

   public function update(Request $request, Evento $evento){
        $validacion = $request->validate([
            'titulo' =>'required|string|max:255',
            'descripcion' =>'required|string|max:255',
            'fecha_inicio' =>'required|date',
            'fecha_fin' =>'required|date',
        ]);
        $evento->update($validacion);

        return redirect()->route('evento.index')->with('message', 'El evento fue editado correctamente');
   }

   public function destroy(Evento $evento){
    Gate::authorize('viewAny');
        $evento->delete();
        return redirect()->route('evento.index')->with('message', 'El evento fue eliminado correctamente');
   }
}
