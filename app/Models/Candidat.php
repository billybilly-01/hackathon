<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'adresse',
        'ville',
        'pays',
        'video',
        'entite',
        'nom_entite',
        'role_id'

    ];

    public function getVideoAttribute($value)
    {
        return url('storage/' . $value);
    }
}
