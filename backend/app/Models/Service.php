<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'prestataire_id',
        'categorie_id',
        'nom',
        'description',
        'tarif',
        'disponibilite',
    ];

    protected $casts = [
        'disponibilite' => 'boolean',
        'tarif' => 'decimal:2',
    ];

    public function prestataire()
    {
        return $this->belongsTo(Prestataire::class, 'prestataire_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'service_id');
    }
}
