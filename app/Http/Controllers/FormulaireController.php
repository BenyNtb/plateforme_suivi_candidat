<?php

namespace App\Http\Controllers;

use App\Models\EvenementType;
use App\Models\Formulaire;
use App\Models\Historiquemailform;
use Illuminate\Http\Request;

class FormulaireController extends Controller
{
    public function index()
    {
        $formulaires = Formulaire::all();
        $evenementTypes = EvenementType::all();
        return view('back.formulaire.index' , compact("formulaires" , "evenementTypes"));
    }

    public function formulaire(Formulaire $id){
        $formulaire = $id;
        $histoForms = Historiquemailform::where('formulaire_id' , $formulaire->id)->get();
        $verifHistoForms = $histoForms->isNotEmpty();
        return view('back.formulaire.formulaire' , compact('formulaire' , 'histoForms' , "verifHistoForms"));
    }

}
