<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmacionMail;

class ParticipanteController extends Controller
{
    public function index()
    {
        $participaciones = Participante::with('evento')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('participantes.index', [
            'participantes' => $participaciones,
        ]);
    }

    public function store(Evento $evento)
    {
        // Verificar si ya está participando
        if(!Participante::where('user_id', auth()->id())
                      ->where('evento_id', $evento->id)
                      ->exists()) {
            Participante::create([
                'estado_participante' => 'CONFIRMADO',
                'evento_id' => $evento->id,
                'user_id' => auth()->user()->id
            ]);
        }
        $email = auth()->user()->email;
        Mail::to($email)->send(new ConfirmacionMail());

        return redirect()->route('evento.show', $evento)
               ->with('message', 'Has confirmado tu participación');
    }

    public function update(Request $request, Evento $evento)
{
    $request->validate([
        'estado_participante' => 'required|in:CONFIRMADO,PENDIENTE,RECHAZADO'
    ]);

    // Buscar la participación actual
    $participante = Participante::where('user_id', auth()->id())
                     ->where('evento_id', $evento->id)
                     ->firstOrFail();

    // Solo actualizar el estado
    $participante->update([
        'estado_participante' => $request->estado_participante
    ]);

    return redirect()->back()
           ->with('success', 'Estado de participación actualizado correctamente');
}

    public function destroy(Evento $evento)
    {
        $participante = Participante::where('user_id', auth()->user()->id)
                      ->where('evento_id', $evento->id)
                      ->firstOrFail();

        $participante->delete();

        return redirect()->route('evento.show', $evento)
               ->with('message', 'Has abandonado el evento');
    }
}