<?php

namespace App\Http\Controllers;

use App\Mail\EvenementSender;
use App\Mail\MailingSender;
use App\Mail\NewsletterSender;
use App\Models\Boitemail;
use App\Models\Classe;
use App\Models\EvenementType;
use App\Models\Mail;
use App\Models\Role;
use App\Models\StockageMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as TestMail;
use PhpParser\Node\Expr\New_;

class MailController extends Controller
{
    function index()
    {
        $emails = Mail::paginate(8);
        return view('back.mail.mail',compact('emails'));
    }
    function create()
    {
        $emails = Mail::all();
        return view('back.mail.create',compact('emails'));
    }
    function create_signature()
    {
        $user = Auth::user();
        // $user->signature  = $request->editeur;
        // dd($user->signature);
        // $user->save();
        return view('back.mail.create_signature',compact('user'));
    }    
    function store_signature(Request $request)
    {
        $user = Auth::user();
        $user->signature  = $request->editeur;
        $user->save();
        return redirect()->route('mail.index');
    }
    function store(User $id,Request $request)
    {
        request()->validate([
            'nom' => ["required","max:350"],
            'editeur' => ["required",'min:100'],
            'sujet' => ["required","max:350"],
        ]);
        $email_template = new Mail();
        $email_template->nom = $request->nom;
        $email_template->contenu = $request->editeur;
        $email_template->sujet = $request->sujet;
        $email_template->basique = 0;
        $email_template->save();
        return redirect()->route('mail.index');
    }
    function edit(Mail $id)
    {
        $email = $id;
        return view('back.mail.edit',compact('email'));
    }
    function update(Mail $id, Request $request)
    {
        request()->validate([
            'nom' => ["required","max:350"],
            'editeur' => ["required",'min:100'],
            'sujet' => ["required","max:350"],
        ]);
        $email = $id;
        $email->nom = $request->nom;
        $email->contenu = $request->editeur;
        $email->sujet = $request->sujet;
        $email->save();
        return redirect()->route('mail.index');
    }
    function write(Mail $id)
    {
        $email = $id;
        $roles  =  Role::all();
        $classes  =  Classe::all();
        $user_all=User::all();
        $formation = EvenementType::all();
        return view('back.mail.write',compact('email','user_all','formation','roles','classes'));
    }
    function newwrite(Mail $id)
    {
        $roles  =  Role::all();
        $classes  =  Classe::all();
        $user_all=User::all();
        $formation = EvenementType::all();
        return view('back.mail.newwrite',compact('user_all','formation','roles','classes'));
    }
    function newsend(Mail $id, Request $request)
    {
        request()->validate([
            'nom' => ["required","max:350"],
            'editeur' => ["required",'min:100'],
            'sujet' => ["required","max:350"],
            'group' => ["required"],
        ]);
        $roles  =  Role::all();
        $classes  =  Classe::all();
        $email = $id;
        $email->nom = $request->nom;
        $email->contenu = $request->editeur;
        $email->sujet = $request->sujet;
        $contenu = $request->editeur;
        //email
        if ($request->group == 1) {
            if ($request->group_1 == 'all') {
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 1,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),
                    
                ]);
                $user = User::all();
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //admin
            elseif ($request->group_1 == 1) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 2,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //partenaire
            elseif ($request->group_1 == 2) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 3,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //candidat
            elseif ($request->group_1 == 3) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 4,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //etudiant
            elseif ($request->group_1 == 4) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 5,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //coach
            elseif ($request->group_1 == 5) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 6,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //selectionné
            elseif ($request->group_1 == 7) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 7,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            };
        }
        elseif($request->group == 2){
            if ($request->group_2 === null) {
                return redirect()->route('mail.index')->with('warning', 'Envoi du mail impossible');
            }
            elseif ($request->group_2 == $request->group_2) {
                $user = User::all()->where('classe_id',$request->group_2);
                $boitemail = Boitemail::create([
                    "id_envoie" => $request->group_2,
                    "groupe"    => 9,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),    
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
        }
        return redirect()->route('mail.index')->with('success', 'Envoi des mails validé');
    }
    function send(Mail $id, Request $request)
    {
        request()->validate([
            'nom' => ["required","max:350"],
            'editeur' => ["required",'min:100'],
            'sujet' => ["required","max:350"],
            'group' => ["required"],
        ]);
        $roles  =  Role::all();
        $classes  =  Classe::all();
        $email = $id;
        $email->nom = $request->nom;
        $email->contenu = $request->editeur;
        $email->sujet = $request->sujet;
        $contenu = $request->editeur;
        //email
        if ($request->group == 1) {
            if ($request->group_1 == 'all') {
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 1,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),
                    
                ]);
                $user = User::all();
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //admin
            elseif ($request->group_1 == 1) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 2,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //partenaire
            elseif ($request->group_1 == 2) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 3,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //candidat
            elseif ($request->group_1 == 3) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 4,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //etudiant
            elseif ($request->group_1 == 4) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 5,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //coach
            elseif ($request->group_1 == 5) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 6,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
            //selectionné
            elseif ($request->group_1 == 7) {
                $user = User::all()->where('role_id',$request->group_1);
                $boitemail = Boitemail::create([
                    "id_envoie" => 3,
                    "groupe"    => 7,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),            
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            };
        }
        elseif($request->group == 2){
            if ($request->group_2 === null) {
                return redirect()->route('mail.index')->with('warning', 'Envoi du mail impossible');
            }
            elseif ($request->group_2 == $request->group_2) {
                $user = User::all()->where('classe_id',$request->group_2);
                $boitemail = Boitemail::create([
                    "id_envoie" => $request->group_2,
                    "groupe"    => 9,
                    "template_id"    => $id->id,
                    "auteur_id"    =>  Auth::user()->id,
                    "sujet"    =>  $request->sujet,
                    "contenu"    => $request->editeur,
                    "created_at"    => now(),    
                ]);
                foreach ($user as $item ) {
                    TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));
                };
            }
        }
        return redirect()->route('mail.index')->with('success', 'Envoi des mails validé');
    }
    function index_student(User $student)
    {
        $emails = Mail::paginate(10);
        $historique = Boitemail::paginate(5);
        $etudiant =  $student;
        return view('back.mail.mail',compact('emails','etudiant','historique'));
    }
    function search(Request $request)
    {
        request()->validate([
            "search" => "required",
        ]);
        $recherche = $request->search;
        $emails = Mail::where('nom', 'LIKE', "%{$recherche}%")->paginate(8);
        return view('back.mail.mail',compact('emails'));
    }
    function write_student(Mail $id,User $student)
    {
        $email = $id;
        $etudiant =  $student;
        $user_all=User::all();
        $formation = EvenementType::all();
        return view('back.mail.write',compact('email','user_all','formation','etudiant'));
    }
    function send_student(Mail $id,User $student, Request $request)
    {
        request()->validate([
            'nom' => ["required","max:350"],
            'editeur' => ["required",'min:100'],
            'sujet' => ["required","max:350"],
        ]);
        // boite mail
        $item = $student;
        $boitemail = Boitemail::create([
            "id_envoie" => $item->id,
            "groupe"    => 0,
            "auteur_id"    =>  Auth::user()->id,
            "template_id"    =>  $id->id,
            "sujet"    =>  $request->sujet,
            "contenu"    => $request->editeur,
            "created_at"    => now(),
        ]);
        $contenu = $request->editeur;
        TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));

        return redirect()->route('mail.index')->with('success', "Votre email est bien envoyé à l'étudiant");
    }
    function newsend_student(Mail $id,User $student, Request $request)
    {
        request()->validate([
            'nom' => ["required","max:350"],
            'editeur' => ["required",'min:100'],
            'sujet' => ["required","max:350"],
        ]);
        // boite mail
        $item = $student;
        $boitemail = Boitemail::create([
            "id_envoie" => $item->id,
            "groupe"    => 0,
            "auteur_id"    =>  Auth::user()->id,
            "template_id"    =>  $id->id,
            "sujet"    =>  $request->sujet,
            "contenu"    => $request->editeur,
            "created_at"    => now(),
        ]);
        $contenu = $request->editeur;
        TestMail::to($item->email)->send(new MailingSender($request, $item, $contenu));

        return redirect()->route('mail.index')->with('success', "Votre email est bien envoyé à l'étudiant");
    }
    function newwrite_student(User $student)
    {
        $user_all=User::all();
        $formation = EvenementType::all();
        return view('back.mail.newwrite',compact('user_all','formation','student'));
    }
    function search_student(Request $request, User $student)
    {
        request()->validate([
            "search" => "required"
        ]);
        $etudiant =  $student;
        $recherche = $request->search;
        $emails = Mail::where('nom', 'LIKE', "%{$recherche}%")->paginate(8);
        return view('back.mail.mail',compact('emails','etudiant'));
    }
}