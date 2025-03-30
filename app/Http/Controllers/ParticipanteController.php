<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;


class ParticipanteController extends Controller
{
    public function store(Evento $evento){
        Participante::create([
            'estado_participante' => 'CONFIRMADO',
            'evento_id' => $evento->id,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('evento.show', $evento)->with('message', 'Haz Confirmado tu participación');
    }

    public function destroy(Evento $evento){
        $participante = Participante::where('user_id', auth()->user()->id)->where('evento_id', $evento->id)->first();
        $participante->delete();
        return redirect()->route('evento.show',  $evento)->with('message', 'Haz Eliminado tu participación');
    }
}
