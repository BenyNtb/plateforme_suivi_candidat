<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
