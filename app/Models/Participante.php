<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participante extends Model
{

    use HasFactory;
    protected $fillable = [
        'estado_participante',
        'user_id',
        'evento_id'
    ];

    // Relación con User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con Evento
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    
}
