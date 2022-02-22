<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Models\SeanceUser;
use App\Models\Sexe;
use App\Models\User;
use App\Models\UserInfos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $etudiants = User::all();
        return view('back.inscription.index', compact('etudiants'));
    }
    public function edit(User $id){
        $user = $id;
        $this->authorize('isRealUser', $user);
        $genre = Sexe::all();
        return view('back.profil.edit',compact("user",'genre'));
    }
    public function update(User $id, Request $request){
        $user = $id;
        $this->authorize('isRealUser', $id);
        request()->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'naissance' => 'required|date|max:255',
            'telephone' => 'required|numeric',
            'email' => 'required|string|email|max:255|',
            'formation' => 'required',
            'statut' => 'required',
            'commune' => 'required',
            'adresse' => 'required',
            'pc' => 'required',
            'objectif' => 'required',

        ]);
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->naissance = $request->naissance;
        $user->telephone = $request->telephone;
        $user->sexe_id = $request->genre;
        $user->role_id = $user->role_id;
        $user->email = $request->email;
        $user->save();

        $infos = UserInfos::where('user_id', $user->id)->first();
        $infos->formation = $request->formation;
        $infos->statut = $request->statut;
        $infos->commune = $request->commune;
        $infos->adresse = $request->adresse;
        $infos->objectif = $request->objectif;
        $infos->pc = $request->pc;
        $infos->save();

        return redirect()->route('dashboard')->with('success', 'Votre profil est bien éditée');
    }

    public function seance()
    {
        return view('back.profil.parcours');
    }
    public function communaute( Request $request)
    {
        if ($request->communaute  == 'oui') {
            $user = User::all()->where('id',Auth::user()->id)->first();
            $user->communaute = 1;
            $user->save();
        } else {

            $user = User::all()->where('id',Auth::user()->id)->first();
            $user->communaute = 0;
            $user->save();
        }
        return redirect()->route('dashboard');
    }

    public function seanceDelete(Seance $id)    
    {
        $seance = $id;
        $seance->limite = $seance->limite+1;
        $seance->save();
        $su = SeanceUser::where('seance_id', $seance->id)->where('user_id', Auth::user()->id)->first();
        $su->delete();
        return redirect()->back()->with('warning', "Vous venez de supprimer une séance");
    }
}
