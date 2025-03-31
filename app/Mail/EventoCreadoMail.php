<?php
namespace App\Mail;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventoCreadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $evento;

    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }

    public function build()
    {
        return $this->subject('Nuevo Evento Creado: ' . $this->evento->titulo)
                    ->view('emails.evento_creado');
    }
}
