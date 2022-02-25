<?php

namespace App\Http\Controllers;

use App\Models\EvenementType;
use App\Models\Seance;
use App\Models\SeanceCandidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as TestMail;

class SeanceController extends Controller
{


    public function inscription(Seance $id)
    {
        $jour = $id;
        $seance_inscrit = new SeanceCandidat();
        $seance_inscrit->candidat_id = Auth::user()->id;
        $seance_inscrit->seance_id = $jour->id;
        $seance_inscrit->presence = 0;
        $seance_inscrit->inscrit = 1;
        $seance_inscrit->save();
        $jour->limite = $jour->limite-1;
        $jour->save();
        return redirect()->route('seance.index')->with('success', 'Vous êtes bien inscrit à la séance');
    }

    



    public function inscriptionItw(EvenementType $id, Seance $seance)
    {
        $inscrit = SeanceCandidat::where('candidat_id', Auth::user()->id)->first();
        $formation = $id;
        $interviews = $formation->seances->where('etape_id', 2)->where('limite', ">", 0)->sortBy('date_debut')->take(1);
        if (count($interviews) == 0) {
            return redirect()->back()->with('warning', 'Pas de date disponible pour l\'interview');
        } else {
            return view('back.profil.inscriptionITW', compact('interviews', 'inscrit'));
        }
        
    }

    public function storeEtape(Request $request, Seance $id)     
    {
        $inscription = SeanceCandidat::all()->where('id',$request->inscrit)->first();
        $inscription->inscrit = 0;
        $inscription->save();
        $jour = $id;
        $seanceUser = new SeanceCandidat();
        $seanceUser->seance_id = $jour->id;
        $seanceUser->candidat_id = Auth::user()->id;
        $seanceUser->presence = 0;
        $seanceUser->inscrit = 1;
        $seanceUser->save();
        $jour->limite = $jour->limite-1;
        $jour->save();

        return redirect()->route('seance.index')->with('success', 'Vous êtes bien inscrit à la séance');
    }

}
