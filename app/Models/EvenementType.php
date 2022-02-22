<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvenementType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function etapes()
    {
        return $this->hasMany(Etape::class);
    }

    public function seances()
    {
        return $this->hasMany(Seance::class);
    }
    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }

    public function candidat()
    {
        return $this->hasMany(Candidat::class);
    }
}
