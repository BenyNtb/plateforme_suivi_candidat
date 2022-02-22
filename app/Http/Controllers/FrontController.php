<?php

namespace App\Http\Controllers;

use App\Models\Etape;
use App\Models\EvenementType;
use App\Models\Seance;
use App\Models\StockageText;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    function index()
    {
        $types = EvenementType::all()->sortBy('evenement_type_id');
        $text_accroche =  StockageText::first();
        return view('home', compact('types','text_accroche'));
    }

    public function showDate(EvenementType $id)
    {
        // dd($id);
        $coding = $id;
        $seances = $coding->seances;
        $text_accroche =  StockageText::first();
        return view('template.showDate', compact('seances', 'text_accroche'));
    }

    public function description(Seance $id)
    {
        $seance = $id;
        $text_accroche =  StockageText::first();
        return view('template.description', compact('seance', 'text_accroche'));
    }
}
