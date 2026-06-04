<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'specialite',
        'localisation',
        'note_moyenne',
        'disponible',
    ];

    protected $casts = [
        'disponible' => 'boolean',
        'note_moyenne' => 'decimal:2',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'prestataire_id');
    }
}
