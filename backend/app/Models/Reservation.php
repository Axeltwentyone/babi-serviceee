<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'utilisateur_id',
        'service_id',
        'date_reservation',
        'heure_reservation',
        'statut',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function avis()
    {
        return $this->hasOne(Avis::class, 'reservation_id');
    }
}
