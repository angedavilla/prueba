<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'tipo_identificacion',
        'numero_identificacion',
        'genero',
        'direccion',
        'telefono',
        'foto_cedula',
        'foto_rostro',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calorias()
    {
        return $this->hasMany(Caloria::class);
    }
}

