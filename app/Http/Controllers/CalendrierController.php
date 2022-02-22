<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class CalendrierController extends Controller
{
    public function index()
    {        
        return view('back.classe_coach.calendrier.index');
    }


    public function show(Presence $id)
    {
        $jour = $id;
        $liste_jour = Presence::all()->where('jour', $jour->jour);
        return view('back.classe_coach.calendrier.show', compact('liste_jour'));
    }

    public function getPDF(Presence $id)
    {
        $jour = $id;
        $liste_jour = Presence::all()->where('jour', $jour->jour);
        $image = base64_encode(file_get_contents(public_path('/img/pdf/bxlformation.png')));
        $classe = $liste_jour->first()->user->classe->nom;
        $pdf = PDF::loadView('layouts.pdf', compact('liste_jour','classe', 'image'));
        // return $pdf->stream();
        return $pdf->download("Liste_presence_". $classe.".pdf");
    }
}
