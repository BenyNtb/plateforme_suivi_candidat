<?php

namespace App\Http\Controllers;

use App\Mail\EvenementSender;
use App\Mail\InvitatioSeanceSender;
use App\Models\Demande_pret;
use App\Models\Etape;
use App\Models\EvenementType;
use App\Models\Mail;
use App\Models\Seance;
use App\Models\SeanceUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as TestMail;

class SeanceController extends Controller
{
    public function index()
    {
        $parcours = Seance::where('etat', 1)->paginate(6);
        $type_event = EvenementType::all();
        $view = 'all';
        $pages = 'visible';
        return view('back.events.index', compact('parcours','type_event','view', 'pages'));
    }
    public function index_tri($item)
    {
        $parcours = Seance::all()->where('etat', 1)->where('evenement_type_id', $item);        
        $type_event = EvenementType::all();
        $view = $item;
        $pages = 'visible';
        return view('back.events.index', compact('parcours','type_event','view', 'pages'));
    }

    public function archive()
    {
        $parcours = Seance::where('etat', 0)->paginate(6);
        $type_event = EvenementType::withTrashed()->get();
        // dd($parcours[2]);
        $view = 'all';
        $pages = 'archives';
        // dd($type_event);
        return view('back.events.archive', compact('parcours','type_event','view', 'pages'));
    }

    public function archive_tri($item)
    {
        $parcours = Seance::all()->where('etat', 0)->where('evenement_type_id', $item);        
        $type_event = EvenementType::withTrashed()->get();
        $view = $item;
        $pages = 'archives';
        return view('back.events.archive', compact('parcours','type_event','view', 'pages'));
    }

    public function inscription(Seance $id)
    {
        $mail = Mail::all()->where('id',1);
        $jour = $id;
        $seance_inscrit = new SeanceUser();
        $seance_inscrit->user_id = Auth::user()->id;
        $seance_inscrit->seance_id = $jour->id;
        $seance_inscrit->presence = 0;
        $seance_inscrit->inscrit = 1;
        $seance_inscrit->save();
        $jour->limite = $jour->limite-1;
        $jour->save();
        $destination = User::all()->where('id',Auth::user()->id);
        $mail = Mail::all()->where('id',2)->first();
        foreach ($destination as $item) {
            $auteur  = User::all()->where('id',1)->first();
            TestMail::to($item->email)->send(new EvenementSender($item,$auteur,$jour,$mail));
        };

        return redirect()->route('seance.index')->with('success', 'Vous êtes bien inscrit à la séance');
    }

    

    public function showDate(Etape $id)
    {
        // dd($id);
        $etape = $id;
        return view('template.showDate', compact('etape'));
    }

    public function inscriptionItw(EvenementType $id, Seance $seance)
    {
        $inscrit = $seance->seance_user->where('user_id', Auth::user()->id)->first();
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
        $inscription = SeanceUser::all()->where('id',$request->inscrit)->first();
        $inscription->inscrit = 0;
        $inscription->save();
        $jour = $id;
        $seanceUser = new SeanceUser();
        $seanceUser->seance_id = $jour->id;
        $seanceUser->user_id = Auth::user()->id;
        $seanceUser->presence = 0;
        $seanceUser->inscrit = 1;
        $seanceUser->save();
        $jour->limite = $jour->limite-1;
        $jour->save();
        $destination = User::all()->where('id',Auth::user()->id);
        $mail = Mail::all()->where('id',2)->first();
        foreach ($destination as  $item) {
            $auteur  = User::all()->where('id',5)->first();
            TestMail::to($item->email)->send(new EvenementSender($item,$auteur,$jour,$mail));
        };


        return redirect()->route('seance.index')->with('success', 'Vous êtes bien inscrit à la séance');
    }

    public function finSeance(Seance $id)
    {
        $seance = $id;
        switch ($seance->etat) {
            case '1':
                $seance->etat = 0;
                $seance->save();
                return redirect()->route('event.index')->with('warning', "La séance a été archivé");        
                break;
            case '0':
                $type = $seance->evenement_type;
                if ($type->trashed()) {
                    $type->restore();
                }
                $seance->etat = 1;
                $seance->save();
                return redirect()->route('event.index')->with('success', "La séance est public");        
                break;
            default:
                break;
        }
    }
    public function etudiants(Seance $id)
    {
        $seance = $id;
        $seances = Seance::all()->where('etape_id', 3);
        $seance_user = SeanceUser::all()->where('seance_id', $seance->id);
        return view('back.events.show_student',compact('seance','seance_user','seances'));
    }

    public function invitation_week(Request $request , User $user)
    {
        $seance = Seance::where('id' , $request->seance)->first();
        //bouton inscrit 
        $bouton = SeanceUser::where('seance_id', $request->invitation)->where('user_id', $request->user)->first();
        $bouton->inscrit = 0;
        $bouton->save();
        // $seance = $seances[0];
        $jour = $seance;
        $item = $user;
        $mail = Mail::all()->where('id',3)->first();
        $auteur  = User::all()->where('id',5)->first();
        TestMail::to($item->email)->send(new InvitatioSeanceSender($item,$auteur,$jour,$mail));
        return redirect()->back();
    }

    public function validation_invitation_week(Seance $seance , User $user){
        if (Auth::user()->id != $user->id) {
            return redirect()->route('home')->with('warning', "Vous n'êtes pas connecté sur le bon compte");

        } else {
            if (SeanceUser::where('user_id' , Auth::user()->id)->where('seance_id' , $seance->id)->count() != 0) {
                return redirect()->route('seance.index')->with('warning', 'Vous êtes déjà inscrit à cette séance');
            } else {
                SeanceUser::create([
                    "seance_id" =>  $seance->id,
                    "user_id"   =>  Auth::user()->id,
                    "presence"  =>  0,
                    "inscrit"    =>  0,
                ]);
                $seance->limite = $seance->limite-1;
                $seance->save();        
                return redirect()->route('seance.index')->with('success', 'Vous êtes bien inscrit à la séance');
            }
        }
    }
    public function validation_invitation_week_pc(Seance $seance , User $user){
        if (Auth::user()->id != $user->id) {
            return redirect()->route('home')->with('warning', "Vous n'êtes pas connecté sur le bon compte");

        } else {
            if (SeanceUser::where('user_id' , Auth::user()->id)->where('seance_id' , $seance->id)->count() != 0) {
                return redirect()->route('seance.index')->with('warning', 'Vous êtes déjà inscrit à cette séance');
            } else {
                Demande_pret::create([
                    "etudiant_id" =>  Auth::user()->id,
                    "pret"  =>  0,
                    "created_at"    =>  now(),
                ]);
                SeanceUser::create([
                    "seance_id" =>  $seance->id,
                    "user_id"   =>  Auth::user()->id,
                    "presence"  =>  0,
                    "inscrit"    =>  0,
                ]);
                $seance->limite = $seance->limite-1;
                $seance->save();        
                return redirect()->route('seance.index')->with('success', 'Vous êtes bien inscrit à la séance');
            }
        }
    }
    public function cloture(Seance $id)
    {
        $seance = $id;
        $seance->max = $seance->max - $seance->limite;
        $seance->limite = 0;
        $seance->save();
        return redirect()->back()->with('warning', 'séance clôturée');
    }
}
