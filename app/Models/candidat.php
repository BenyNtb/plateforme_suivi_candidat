<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidat extends Authenticatable
{
    use HasFactory;
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function infos()
    {
        return $this->hasOne(CandidatInfo::class);
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
}
