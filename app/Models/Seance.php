<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;
    public function inscrits(){
        return $this->belongsToMany(Seance::class , 'seance_candidats' , 'candidat_id');
    }

    public function seance_candidat()
    {
        return $this->hasMany(SeanceCandidat::class, 'user_id');
    }


}
