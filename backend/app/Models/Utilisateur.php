<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'telephone',
        'adresse',
        'role',
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'utilisateur_id');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class, 'utilisateur_id');
    }

    public function signalements()
    {
        return $this->hasMany(Signalement::class, 'utilisateur_id');
    }
}
