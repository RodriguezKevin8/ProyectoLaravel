<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
   
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'isAdmin',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function eventosCreados()
    {
        return $this->hasMany(Evento::class);
    }

    // Relación con Participantes
    public function participaciones()
    {
        return $this->hasMany(Participante::class);
    }

    // Relación con Reportes
    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }

    // Relación con Notificaciones
    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class);
    }
    
}
