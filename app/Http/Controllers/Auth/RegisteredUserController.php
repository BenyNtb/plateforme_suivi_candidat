<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidat;
use App\Models\CandidatInfo;
use App\Models\Genre;
use App\Models\Seance;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Seance $id)
    {
        $seance = $id;
        $genres = Genre::all();
        return view('auth.register', compact('seance', 'genres'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:candidats'],
            'password' => ['required', Rules\Password::defaults()],
        ]);



        $user = Candidat::create([
            'nom' => $request->nom,
            'prenom'=>$request->prenom,
            'email' => $request->email,
            'role_id'=> 1,
            'genre_id' => $request->genre, 
            'password' => Hash::make($request->password),
        ]);

        $infos = new CandidatInfo();
        $infos->candidat_id = $user->id;
        $infos->date_naissance = $request->naissance;
        $infos->phone = $request->telephone;
        $infos->motivation = $request->interet;
        $infos->statut = $request->statut;
        $infos->commune = $request->commune;
        $infos->parcours = $request->parcours;
        $infos->adresse = $request->adresse;
        $infos->pc = $request->pc;
        $infos->objectif = $request->objectif;
        $infos->save();

        event(new Registered($user));

        // Auth::login($user);
        if(auth()->guard('candidat')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $user = auth()->user();

            return redirect()->intended(url('/dashboard'));
        } else {
            return redirect()->back()->withError('Credentials doesn\'t match.');
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
