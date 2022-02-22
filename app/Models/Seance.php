<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    public function evenement_type()
    {
        return $this->belongsTo(EvenementType::class, 'evenement_type_id')->withTrashed();
    }

    public function etape()
    {
        return $this->belongsTo(Etape::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'seance_users', 'seance_id');
    }

    public function seance_user(){
        return $this->hasMany(SeanceUser::class);
    }

    public function coachino()
    {
        return $this->belongsToMany(User::class, 'coach_weeks', 'seance_id');
    }
    
    //& Ayoub
    public function carouselevent(){
        return $this->hasOne(Carouselevent::class);
    }
}
