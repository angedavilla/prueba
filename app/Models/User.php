<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'password', 'persona_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function persona()
    {
        return $this->hasOne(Persona::class);
    }

    // Añade este método para Passport usar el campo 'name'
    public function findForPassport($username)
    {
        return $this->where('name', $username)->first();
    }
}


