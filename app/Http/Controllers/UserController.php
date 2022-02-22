<?php

namespace App\Http\Controllers;

use App\Models\AllCommentaire;
use App\Models\Classe;
use App\Models\Commentaire;
use App\Models\EvenementType;
use App\Models\FormMolengeek;
use App\Models\FormPartenaire;
use App\Models\Role;
use App\Models\Seance;
use App\Models\SeanceUser;
use App\Models\Sexe;
use App\Models\User;
use App\Models\UserInfos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $current_view = 'all';
        $etudiants = User::orderBy('nom')->where('role_id', 3)->orWhere('role_id', 4)->paginate(8);
        $roles = Role::all();
        $recherche = '';

        return view('back.etudiant.index', compact('etudiants', 'roles', 'current_view', 'recherche'));
    }
    public function index_candidat()
    {
        $current_view = 'candidat';
        $etudiants = User::orderBy('nom')->where('role_id', 3)->paginate(8);
        $roles = Role::all();
        $recherche = '';
        return view('back.etudiant.index', compact('etudiants', 'roles', 'current_view', 'recherche'));
    }

    public function index_etudiant()
    {
        $current_view = 'etudiant';
        $etudiants = User::orderBy('nom')->where('role_id', 4)->paginate(8);
        $roles = Role::all();
        $recherche = '';
        return view('back.etudiant.index', compact('etudiants', 'roles', 'current_view', 'recherche'));
    }
    public function edit(User $id)
    {
        $etudiant = $id;
        $roles = Role::all();
        $genres = Sexe::all();
        return view('back.etudiant.edit', compact('etudiant', 'roles', 'genres'));
    }
    public function update(User $id, Request $request)
    {
        request()->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'naissance' => 'required|date|max:255',
            'genre' => 'required',
            'telephone' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            'formation' => 'required',
            'statut' => 'required',
            'commune' => 'required',
            'adresse' => 'required',
            'pc' => 'required',
            'objectif' => 'required',
        ]);
        $user = $id;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->naissance = $request->naissance;
        $user->telephone = $request->telephone;
        $user->sexe_id = $request->genre;
        $user->save();
        $infos = UserInfos::where('user_id', $user->id)->first();
        $infos->formation = $request->formation;
        $infos->statut = $request->statut;
        $infos->commune = $request->commune;
        $infos->adresse = $request->adresse;
        $infos->pc = $request->pc;
        $infos->objectif = $request->objectif;
        $infos->save();
        return redirect()->route('etudiant.index')->with('success', 'le profil de l\'étudiant a été édité');
    }
    public function search(Request $request)
    {
        request()->validate([
            "search" => "required",
        ]);
        $current_view = 'recherche';
        $recherche = $request->search;
        $etudiants = User::orderBy('nom')->where('nom', 'LIKE', "%{$recherche}%")->orWhere('prenom', 'LIKE', "%{$recherche}%")->paginate(8);
        return view('back.etudiant.index', compact('etudiants', 'current_view', 'recherche'));
    }
    public function show(User $id)
    {
        $etudiant = $id;
        $form_molen  = FormMolengeek::all();
        $form_part  = FormPartenaire::all();
        $commentaires = Commentaire::all()->where('candidat_id', $etudiant->id);
        return view('back.etudiant.show', compact('etudiant', 'commentaires', 'form_molen', 'form_part'));
    }
    public function addcomment(Request $request, User $etudiant)
    {
        $commentaire =  new  Commentaire();
        $commentaire->auteur_id = Auth::user()->id;
        $commentaire->candidat_id = $etudiant->id;
        $commentaire->sujet = $request->sujet;
        $commentaire->Contenu = $request->contenu;
        $commentaire->created_at = now();
        $commentaire->save();
        return redirect()->back();
    }
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();
        return redirect()->back();
    }

    public function presence(User $id, Seance $seance)
    {
        $user = $id;
        $seanceUser = SeanceUser::all()->where('seance_id', $seance->id)->where('user_id', $user->id)->first();
        switch ($seanceUser->presence) {
            case '0':
                $seanceUser->presence = 1;
                $seanceUser->save();
                break;
            case '1':
                $seanceUser->presence = 0;
                $seanceUser->save();
                break;
            default:
                break;
        }
        return redirect()->back();
    }

    public function admis(User $id)
    {
        $user = $id;
        $user->role_id = 6; // role sélectionné.e
        $user->save();
        return redirect()->back();
    }
}
