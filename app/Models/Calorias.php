<?php

// app/Models/Caloria.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calorias extends Model
{
    use HasFactory;

    protected $fillable = [
        'alimento', 'cantidad', 'calorias', 'fecha', 'hora', 'user_id', 'persona_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}

