<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidat extends Authenticatable
{
    use HasFactory;
    
    protected $fillable= [
        "nom",
        "prenom",
        "email",
        "role_id",
        "genre_id",
        "password"
    ];

    public function infos()
    {
        return $this->hasOne(CandidatInfo::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

    public function seance_candidat()
    {
        return $this->hasMany(SeanceCandidat::class, 'candidat_id');
    }
    
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
