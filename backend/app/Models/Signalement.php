<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signalement extends Model
{
    protected $fillable = [
        'utilisateur_id',
        'avis_id',
        'motif',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function avis()
    {
        return $this->belongsTo(Avis::class, 'avis_id');
    }
}
