<?php

namespace App\Http\Controllers;

use App\Models\EvenementType;
use App\Models\Seance;
use App\Models\StockageText;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    function index()
    {
        $types = EvenementType::all()->sortBy('evenement_type_id');
        return view('home', compact('types'));
    }

    public function showDate(EvenementType $id)
    {
        $coding = $id;
        $seances = $coding->seances;
        return view('template.showDate', compact('seances'));
    }

    public function description(Seance $id)
    {
        $seance = $id;
        return view('template.description', compact('seance'));
    }
}
