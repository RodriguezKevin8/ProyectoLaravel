<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reporte extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion', 'fecha_generacion', 'user_id'
    ];

    protected $dates = [
        'fecha_generacion'
    ];

    // Relación con User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
