<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

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
        return $this->hasMany(SeanceCandidat::class, 'candidat_id   ');
    }
    
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
