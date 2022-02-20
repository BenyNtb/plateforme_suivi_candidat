<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\CoachSeance;
use App\Models\EvenementType;
use App\Models\HistoPresence;
use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    //coach classe
    public function index()
    {
        return view('back.classe_coach.index');
    }

    public function presence_store(Request $request)
    {
        
        $this->authorize('isCoach');
        $request->validate([
            'jour'=>'required|date', 
            'distance_presence'=>'required'
        ]);

        $classe = Classe::find($request->classe);
        foreach ($classe->users as $etudiant) {
            $presence = new Presence();
            $presence->user_id = $etudiant->id;
            $presence->classe_id = $request->classe;
            $presence->jour = $request->jour;
            $presence->distance_presence = $request->distance_presence;
            $presence->save();
        }
        //store le coach
        $presence = new Presence();
        $presence->user_id = $request->coach;
        $presence->classe_id = $request->classe;
        $presence->jour = $request->jour;
        $presence->distance_presence = $request->distance_presence;
        $presence->save();

        
        return redirect()->route('presence.classe' , $classe->id);
    }

    public function liste_presence(Classe $id)
    {
        $this->authorize('isCoach');
        $classe = $id;
        $presence = Presence::latest()->first();
        return view('back.classe_coach.presence', compact('classe', 'presence'));
    }

    public function heure_arrivee(Request $request)
    {
        $this->authorize('isCoach');
        $request->validate([
            "arrivee"=>'required'
        ]);
        $arrivee = new HistoPresence();
        $arrivee->presence_id = $request->presence;
        $arrivee->heure_arrivee = $request->arrivee;
        $arrivee->arrivee = 1;
        $arrivee->save();
        return redirect()->back();
    }

    public function heure_depart(Request $request, HistoPresence $id)
    {
        $this->authorize('isCoach');
        $request->validate([
            'depart'=>'required',
        ]);
        $update = $id;
        $update->heure_depart = $request->depart;
        $update->depart = 1;
        $update->save();
        return redirect()->back();
    }

    public function update_horaire(Request $request, HistoPresence $id)
    {
        $this->authorize('isCoach');
        $request->validate([
            'departEdit'=>"required",
            'arriveeEdit'=>'required',
        ]);
        $update = $id;
        $update->heure_depart = $request->departEdit;
        $update->heure_arrivee = $request->arriveeEdit;
        $update->save();
        return redirect()->back();
    }
    // GESTION
    public function index_gestion()
    {
        $current_view = 'candidat';
        $etudiants = User::orderBy('nom')->where('role_id', 4)->orWhere('role_id', 6)->paginate(8);
        $roles = User::all()->where('role_id', 5);
        $recherche = '';
        $dateJour = Carbon::now();
        $classes = Classe::all()->where('etat', 1)->where('date_debut', '>', $dateJour->format('o-m-d'));
        $types = EvenementType::all();

        return view('back.gestion.index', compact('etudiants', 'roles', 'current_view', 'recherche', 'classes', 'types'));
    }
    public function store_classe(Request $request)
    {
        request()->validate([
            "formation" => ["required"],
            "coach" => ["required"],
            "types" => ["required"],
        ]);
        // return dd($request->coach2 != null);
        $classes = new Classe();
        $classes->nom = $request->formation;
        $classes->count = 0;
        $classes->evenement_type_id = $request->types;
        $classes->date_debut = $request->date_debut;
        $classes->date_fin = $request->date_fin;
        $classes->etat = 1;
        $classes->save();
        $coach_classe = new CoachSeance();
        $coach_classe->classe_id = $classes->id;
        $coach_classe->user_id = $request->coach;
        $coach_classe->save();
        //inscrire un 2e coach
        if ($request->coach2 != null) {
            $coach_classe = new CoachSeance();
            $coach_classe->classe_id = $classes->id;
            $coach_classe->user_id = $request->coach2;
            $coach_classe->save();
    
        }
        return redirect()->route('gestion.index')->with('success', 'La classe a bien été créée');
    }
    public function etudiant_classe(User $user, Request $request)
    {
        switch ($user->attribution) {
            case '0':
                $classe = Classe::where('id', $request->classe)->first();
                $classe->count = $classe->count + 1;
                $classe->save();
                $user->attribution = 1;
                $user->classe_id =  $request->classe;
                $user->role_id = 4;
                $user->save();
                break;
            case '1':
                $classe = Classe::where('id', $request->classe)->first();
                $classe->count = $classe->count - 1;
                $classe->save();
                $user->attribution = 0;
                $user->classe_id = null;
                $user->role_id = 6;
                $user->save();
                break;

            default:
                break;
        }

        return redirect()->route('gestion.index');
    }
    public function show_classe(Classe $id)
    {
        $classe = $id;
        $etudiants = User::all();
        $types = EvenementType::all();
        return view('back.gestion.showclasse', compact('classe', 'etudiants', 'types'));
    }
    public function archive()
    {
        $dateJour = Carbon::now();
        $classes = Classe::all()
        ->where('date_debut', '<', $dateJour->format('o-m-d'));
        // ->orWhere('etat', 0 );
        $view = 'all';
        $pages = 'archives';
        return view('back.gestion.archive', compact('classes', 'view', 'pages'));
    }

    public function edit_classe(Classe $id)
    {
        $classe = $id;
        $roles = User::all()->where('role_id', 5);
        $types = EvenementType::all();
        return view('back.gestion.editClasse', compact('classe', 'types', 'roles'));

    }

    public function update_classe(Classe $id, Request $request)
    {
        request()->validate([
            "formation" => ["required"],
            "coach" => ["required"],
            "types" => ["required"],
        ]);
        $classe = $id;
        $classe->nom = $request->formation;
        $classe->evenement_type_id = $request->types;
        $classe->date_debut = $request->date_debut;
        $classe->date_fin = $request->date_fin;
        $classe->save();
        $coach = CoachSeance::all()->where('classe_id', $classe->id);
        foreach ($coach as $co ) {
            $co->delete();

        }
        $coach_classe = new CoachSeance();
        $coach_classe->classe_id = $classe->id;
        $coach_classe->user_id = $request->coach;
        $coach_classe->save();

        if ($request->coach2 !== null) {
            $coach_classe = new CoachSeance();
            $coach_classe->classe_id = $classe->id;
            $coach_classe->user_id = $request->coach2;
            $coach_classe->save();
        }    

        return redirect()->route('gestion.index')->with('success', 'La classe a été mise à jour');

    }
}
