<?php

namespace App\Mail;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $evento;

    public function __construct()
    {
      
    }

    public function build()
    {
        return $this->subject('Inscripción Confirmada')
                    ->view('emails.eventoConfirmar');
    }
}
