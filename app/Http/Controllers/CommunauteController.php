<?php

namespace App\Http\Controllers;

use App\Mail\CommunauteSender;
use App\Mail\MailingSender;
use App\Mail\NewsletterSender;
use App\Models\Boitemail;
use App\Models\Communaute;
use App\Models\Mail;
use App\Models\StockageText;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail as TestMail;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CommunauteController extends Controller
{
    public function index()
    {
        $recherche = null;
        $communaute =  Communaute::paginate(8);
        $text_accroche =  StockageText::first();
        return view('back.communaute.index',compact("recherche",'communaute','text_accroche'));
    }
    public function write()
    {
        $recherche = null;
        $communaute =  Communaute::paginate(8);
        $text_accroche =  StockageText::first();
        return view('back.communaute.write',compact("recherche",'communaute','text_accroche'));
    }
    public function send(Request $request)
    {
        request()->validate([
            'editeur' => ["required",'min:100'],
            'sujet' => ["required","max:350"],
        ]);
        
        $contenu = $request->editeur;
        $communaute =  Communaute::all();
        $boitemail = Boitemail::create([
            "id_envoie" => 1,
            "groupe"    => 8,
            "auteur_id"    =>  Auth::user()->id,
            "template_id"    =>  7,
            "sujet"    =>  $request->sujet,
            "contenu"    => $request->editeur,
            "created_at"    => now(),
        ]);

        foreach ($communaute as $item) {
            TestMail::to($item->email)->send(new CommunauteSender($request, $item, $contenu));
        }
        return redirect()->route('mail.index')->with('success', 'Votre email est bien envoyé à la communauté');
    }
    public function delete(Communaute $id)
    {
        $id->delete();
        return redirect()->route('communaute.index')->with('warning', 'Utilisateur bien suprimé de la communauté');
    }
    public function change (Request $request, StockageText $id)
    {
        request()->validate([
            'texte' => ["required"],            
        ]);
        $id->texte = $request->texte;
        $id->save();
        return redirect()->route('communaute.index')->with('success', 'Votre texte est bien édité');
    }
    public function store_guest (Request $request)
    {
        request()->validate([
            'email' => ["required","email"],
        ]);
        $allcommunaute = Communaute::all();
        if ( $allcommunaute->contains('email', $request->email)) {
            return redirect()->back()->with('warning', 'votre email est déjà inscrit');
        } else {
        $communaute = new Communaute();
        $communaute->email = $request->email;
        $communaute->save();
        // mail
        $mail = Mail::all()->where('id',6)->first();
        $auteur  = User::all()->where('id',5)->first();
        TestMail::to($communaute->email)->send(new NewsletterSender($mail,$auteur));
        return redirect()->route('home')->with('success', 'Bienvenu dans la Communauté Molengeek ');
        }
    }
    public function store_auth (Request $request)
    {
        $allcommunaute = Communaute::all();
        if ( $allcommunaute->contains('email', Auth::user()->email)) {
            return redirect()->back()->with('warning', 'votre compte est déjà inscrit');
        } else {
            $communaute = new Communaute();
            $communaute->email = Auth::user()->email;
            $communaute->created_at = now();
            $communaute->save();
            // mail
            $mail = Mail::all()->where('id',6)->first();
            $auteur  = User::all()->where('id',5)->first();
            TestMail::to($communaute->email)->send(new NewsletterSender($mail,$auteur));
            return redirect()->route('home')->with('success', 'Bienvenu dans la Communauté Molengeek ');;
        }
        
    }
    function search(Request $request)
    {
        request()->validate([
        ]);
        $recherche = $request->search;
        $text_accroche =  StockageText::first();
        $communaute = Communaute::where('email', 'LIKE', "%{$recherche}%")->paginate(8);
        return view('back.communaute.index',compact("recherche",'communaute','text_accroche'));
    }

}