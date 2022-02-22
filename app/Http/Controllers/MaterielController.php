<?php

namespace App\Http\Controllers;

use App\Models\Demande_pret;
use App\Models\Materiel;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use PDF;

class MaterielController extends Controller
{
    public function index()
    {
        $currentpage = "all";
        $materiels = Materiel::paginate(5);
        return view('back.materiel.index',compact('materiels','currentpage'));
    }
    public function view($numero)
    {
        $allmateriels = Materiel::all();
        $alldemande  = Demande_pret::all()->where('pret', 0);
        $materiel = $allmateriels->where('numero', $numero)->first();
        return view('back.materiel.view',compact('materiel','alldemande'));
    }
    public function create()
    {
        $allmateriel = Materiel::all();
        $random       =   rand(10000000,99999999);
        while ($allmateriel->contains('numero', $random) ===true) {
            $random =   rand(10000000,99999999);
        }
        return view('back.materiel.create',compact('random'));
    }
    public function store(Request $request)
    {
        request()->validate([
            'type' => ["required","min:2"],
            'numero' => ["required"],
        ]);
        $materiel = Materiel::create([
            "type"           =>  $request->type,
            "numero"           =>  $request->numero,
            "notes"           =>  $request->notes,
            "dispo"           =>  1,
            "etudiant_id"           =>  null,
            "created_at"    =>  now(),
        ]);
        return redirect()->route('materiel.index')->with('success', 'Matériel crée');;
    }
    public function edit(Materiel $id)
    {
        $materiel = $id;
        return view('back.materiel.edit',compact("materiel"));
    }
    public function update(Materiel $id, Request $request)
    {
        request()->validate([
            'type' => ["required","min:2"],
            'numero' => ["required"],
        ]);
        $materiel = $id;
        $materiel->type = $request->type;
        $materiel->notes = $request->notes;
        $materiel->save();
        return redirect()->route('materiel.index')->with('success', 'Matériel modifié ');;
    }
    public function update_student(Materiel $id, Request $request)
    {
        $materiel = $id;
        $materiel->etudiant_id = $request->etudiant;
        $materiel->dispo = 0;
        $materiel->save();
        $pret = Demande_pret::all()->where('etudiant_id',$request->etudiant)->first();
        $pret->pret =1;
        $pret->save();
        return redirect()->route('materiel.index')->with('success', 'Matériel attribué à un étudiant ');;
    }

    
    public function index_disponible()
    {
        $currentpage = "dispo";
        $materiels = Materiel::where('dispo', 1)->paginate(5);
        return view('back.materiel.index',compact('materiels','currentpage'));
    }
    public function index_nondisponible()
    {
        $currentpage = "non_dispo";
        $materiels = Materiel::where('dispo', 0)->paginate(5);
        return view('back.materiel.index',compact('materiels','currentpage'));
    }
    function search(Request $request)
    {
        request()->validate([
            'search' =>["required","numeric"]
        ]);
        $currentpage = "search";
        $recherche = $request->search;
        $materiels = Materiel::where('numero', 'LIKE', "%{$recherche}%")->paginate(5);
        return view('back.materiel.index',compact('materiels','recherche','currentpage'));

    }
    public function getPDF(Materiel $id)
    {
        $materiel = $id;
        $pdf = PDF::loadView('back.materiel.qrcode', compact('materiel'));
        // return $pdf->stream();
        return $pdf->download("QRcode_". $materiel->numero.".pdf");
    }

}
