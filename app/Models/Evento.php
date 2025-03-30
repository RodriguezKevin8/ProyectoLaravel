<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Evento extends Model
{
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'user_id'
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    public function creador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con Participantes
    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }

    // Relación con Notificaciones
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }

    // Accesor para obtener todos los usuarios participantes
    public function usuariosParticipantes()
    {
        return $this->belongsToMany(User::class, 'participantes', 'evento_id', 'user_id')
                   ->withPivot('estado_participante')
                   ->withTimestamps();
    }
    
}
