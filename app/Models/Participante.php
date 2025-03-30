<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $fillable = [
        'estado_participante',
        'user_id',
        'evento_id'
    ];
}
