<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'mensaje', 'fecha_creacion', 'user_id', 'evento_id'
    ];

    protected $dates = [
        'fecha_creacion'
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
