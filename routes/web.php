<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//front
Route::get('/', [FrontController::class, 'index'])->name('home');

Route::post('/admin/communaute/create/', [CommunauteController::class, 'store_guest'])->name('communauté.store_guest');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('back/dashboard');
})->middleware(['auth:candidat'])->name('dashboard');

require __DIR__ . '/auth.php';

//middleware AUTH
Route::middleware(['auth:candidat'])->group(function () {
    //inscription séance
    Route::post('/dashboard/inscrit/{id}', [SeanceController::class, "inscription"])->name('inscription');

    // candidat inscrit
    Route::get('/admin/users', [ProfilController::class, 'index'])->name('inscription.index');
    // Validation seance WEEK
    Route::get('/back/event/{seance}/{user}/validation/invitation/week', [SeanceController::class, 'validation_invitation_week'])->name('event.validation_week');
    Route::get('/back/event/{seance}/{user}/validation/invitation/week/pc', [SeanceController::class, 'validation_invitation_week_pc'])->name('event.validation_week_pc');
    //profil
    Route::put('/back/profil/communaute', [ProfilController::class, 'communaute'])->name('form.communaute');
    Route::get('/back/profil/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/back/profil/{id}/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/back/profil/seances', [ProfilController::class, 'seance'])->name('seance.index');
    Route::get('/back/profil/seances/etape-interview/{id}/{seance}', [SeanceController::class, "inscriptionItw"])->name('inscription.date');
    Route::post('/back/profil/seances/interview/{id}', [SeanceController::class, "storeEtape"])->name('inscription.interview');
    Route::get('/back/annulation/seance/{id}', [ProfilController::class, 'seanceDelete'])->name('seance.cancel');
    //mail
    Route::get('/back/mail', [MailController::class, 'index'])->name('mail.index');
    Route::get('/back/mail/create', [MailController::class, 'create'])->name('mail.create');
    Route::post('/back/mail/store', [MailController::class, 'store'])->name('mail.store');
    Route::get('/back/mail//{id}/edit', [MailController::class, 'edit'])->name('mail.edit');
    Route::put('/back/mail/{id}/update', [MailController::class, 'update'])->name('mail.update');
    Route::get('/back/mail//{id}/write', [MailController::class, 'write'])->name('mail.write');
    Route::put('/back/mail/{id}/send', [MailController::class, 'send'])->name('mail.send');
    Route::get('/back/mail/write', [MailController::class, 'newwrite'])->name('newmail.write');
    Route::put('/back/mail/send', [MailController::class, 'newsend'])->name('newmail.send');
    Route::get('/admin/mail/recherche', [MailController::class, 'search'])->name('mail.search');
    //mail student
    Route::get('/back/mail/{student}', [MailController::class, 'index_student'])->name('mail.student.index');
    Route::get('/back/mail//{id}/write/{student}', [MailController::class, 'write_student'])->name('mail.student.write');
    Route::put('/back/mail/{id}/send/{student}', [MailController::class, 'send_student'])->name('mail.student.send');
    Route::get('/admin/mail/recherche/{student}', [MailController::class, 'search_student'])->name('mail.search.student');
    Route::get('/back/mail/write/{student}', [MailController::class, 'newwrite_student'])->name('newmail.write.student');
    Route::put('/back/mail/send/{student}', [MailController::class, 'newsend_student'])->name('newmail.send.student');
    // COMMUNAUTE
    Route::get('/admin/communaute/create/{id}', [CommunauteController::class, 'store_auth'])->name('communauté.store_auth');
    // boite mail:
    Route::get('/admin/boitemail', [BoitemailController::class, 'boitemail'])->name('mail.boitemail');
    Route::get('/admin/boitemail/{student}', [BoitemailController::class, 'boitemail_student'])->name('mail.boitemail.student');
    Route::get('/admin/boitemail/show/{id}', [BoitemailController::class, 'boitemail_show'])->name('mail.boitemail.show');
    // Condition:
    Route::get('/admin/condition', [CondtitionController::class, 'index'])->name('condition.index');


    // ETUDIANT
    Route::get('/admin/etudiant/all', [UserController::class, 'index'])->name('etudiant.index');
    Route::get('/admin/etudiant/candidat', [UserController::class, 'index_candidat'])->name('etudiant.index_candidat');
    Route::get('/admin/etudiant/etudiant', [UserController::class, 'index_etudiant'])->name('etudiant.index_etudiant');
    Route::get('/admin/etudiant/edit/{id}', [UserController::class, 'edit'])->name('etudiant.edit');
    Route::put('/admin/etudiant/update/{id}', [UserController::class, 'update'])->name('etudiant.update');
    Route::get('/admin/etudiant/{id}/show', [UserController::class, 'show'])->name('etudiant.show');
    Route::get('/admin/etudiant/recherche', [UserController::class, 'search'])->name('search');
    Route::put('/admin/etudiant/admis/{id}', [UserController::class, 'admis'])->name('etudiant.admis');
    //commentaire
    Route::post('/admin/etudiant/addcommentaire/{etudiant}', [UserController::class, 'addcomment'])->name('etudiant.addcom');
    Route::delete('/admin/etudiant/commentaire/{commentaire}/destroy', [UserController::class, 'destroy'])->name('etudiant.commentaire.destroy');

    // FORMULAIRE
    Route::get('/admin/formulaire', [FormulaireController::class, 'index'])->name('formulaire.index');
    Route::get('/formulaire/{id}/admin/show/', [FormulaireController::class, 'formulaire'])->name('formulaire');
    Route::get('/formulaire/admin/create', [CreateFormController::class, "create"])->name('formulaire.create');
    Route::post('/formulaire/admin/store', [CreateFormController::class, "store"])->name('formulaire.store');
    Route::delete('/admin/formulaire/{id}/destroy', [DeleteForFormController::class, "destroyForm"])->name('formulaire.destroyForm');

    Route::delete('/formulaire/{id}/destroy/question', [DeleteForFormController::class, "destroyQuestion"])->name('question.destroyQuestion');

    //& CAROUSEL &//
    Route::get('/carousel/index', [CarouselController::class, "index"])->name('carousel.index');

    Route::post('/carousel/image/store', [CarouselController::class, "storeImage"])->name("carousel.storeImage");
    Route::delete('/carousel/image/{id}/destroy', [CarouselController::class, "destroyImage"])->name("carousel.destroyImage");

    Route::put('/carousel/update/{id}/timer', [CarouselController::class, "changeTimer"])->name('carousel.changeTimer');

    Route::post('/carousel/video/store', [CarouselController::class, "storeVideo"])->name('carousel.storeVideo');
    Route::delete('/carousel/video/{id}/destroy', [CarouselController::class, "destroyVideo"])->name('carousel.destroyVideo');

    Route::post('/carousel/url/store', [CarouselController::class, 'storeUrl'])->name('carousel.storeUrl');
    Route::delete('/carousel/url/{id}/destroy', [CarouselController::class, "destroyUrl"])->name('carousel.destroyUrl');

    Route::post('/carousel/evenement/type/store', [CarouselController::class, "storeEvent"])->name('carousel.storeEvent');
    Route::delete('/carousel/evenement/type/{id}/destroy', [CarouselController::class, "destroyEvent"])->name('carousel.destroyEvent');

    Route::put('/carousel/checkbox/{id}/true', [CarouselController::class, "checkboxTrue"])->name('carousel.checkboxTrue');
    Route::put('/carousel/checkbox/{id}/false', [CarouselController::class, "checkboxFalse"])->name('carousel.checkboxFalse');

    Route::put('/carousel/order/{id}/switch', [CarouselController::class, "changeOrder"])->name('carousel.changeOrder');
    //& CAROUSEL &//

    //& PARENTHESE &//
    Route::get('/formulaire/{id}/create/simple/question', [CreateQuestionController::class, "createSimple"])->name('question.createSimple');
    Route::get('/formulaire/{id}/create/complexe/question', [CreateQuestionController::class, "createComplexe"])->name('question.createComplexe');
    Route::get('/formulaire/{id}/create/date/question', [CreateQuestionController::class, "createDate"])->name('question.createDate');
    Route::get('/formulaire/{id}/create/number/question', [CreateQuestionController::class, "createNumber"])->name('question.createNumber');
    Route::get('/formulaire/{id}/create/email/question', [CreateQuestionController::class, "createEmail"])->name('question.createEmail');
    Route::get('/formulaire/{id}/create/choixunique/question', [CreateQuestionController::class, "createchoixUnique"])->name('question.createChoixUnique');
    Route::get('/formulaire/{id}/add/create/choixunique/question', [CreateQuestionController::class, "createAddChoixUnique"])->name('question.createAddChoixUnique');
    Route::get('/formulaire/{id}/create/choixmultiple/question', [CreateQuestionController::class, "createChoixMultiple"])->name('question.createChoixMultiple');
    Route::get('/formulaire/{id}/add/create/choixmultiple/question', [CreateQuestionController::class, "createAddChoixMultiple"])->name('question.createAddChoixMultiple');
    Route::get('/formulaire/{id}/show/reponse/for/user', [StoreFormController::class, "showUserForm"])->name('formulaire.showUserForm');
    Route::post('/formulaire/{id}/update/form', [StoreFormController::class, "updateUserForm"])->name('formulaire.updateUserForm');

    Route::put('formulaire/{id}/store/simple/question', [CreateQuestionController::class, "storeSimple"])->name('question.storeSimple');
    Route::put('formulaire/{id}/store/complexe/question', [CreateQuestionController::class, "storeComplexe"])->name('question.storeComplexe');
    Route::put('formulaire/{id}/store/date/question', [CreateQuestionController::class, "storeDate"])->name('question.storeDate');
    Route::put('formulaire/{id}/store/number/question', [CreateQuestionController::class, "storeNumber"])->name('question.storeNumber');
    Route::put('formulaire/{id}/store/email/question', [CreateQuestionController::class, "storeEmail"])->name('question.storeEmail');
    Route::put('/formulaire/{id}/store/choixunique/question', [CreateQuestionController::class, "storeChoixUnique"])->name('question.storeChoixUnique');
    Route::put('/formulaire/{id}/add/store/choixunique/question', [CreateQuestionController::class, "storeAddChoixUnique"])->name('question.storeAddChoixUnique');
    Route::delete('/formulaire/{id}/delete/choixunique', [DeleteForFormController::class, "destroyChoixUnique"])->name("question.destroyChoixUnique");
    Route::put('/formulaire/{id}/store/choixmultiple/question', [CreateQuestionController::class, "storeChoixMultiple"])->name("question.storeChoixMultiple");
    Route::put('/formulaire/{id}/add/store/choixmultiple/question', [CreateQuestionController::class, "storeAddChoixMultiple"])->name("question.storeAddChoixMultiple");
    Route::delete('/formulaire/{id}/delete/choixmultiple/question', [DeleteForFormController::class, "destroyChoixMultiple"])->name("question.destroyChoixMultiple");
    Route::put('/formulaire/{id}/update/questions', [StoreFormController::class, "saveUpdate"])->name('formulaire.saveUpdate');
    //& PARENTHESE &//
    // REMPLIR LE FORM PAR ETUDIANT
    Route::get('/formulaire/created/{id}/show', [StoreFormController::class, "show"])->name('createdForm.show');
    Route::put('/formulaire/created/{id}/store', [StoreFormController::class, "store"])->name('createdForm.store');

    //classe coach 
    Route::get('/classe', [ClasseController::class, 'index'])->name('index.classe');
    Route::post('/classe/creation', [ClasseController::class, 'presence_store'])->name('presence.store');
    Route::get('/classe/presence/{id}', [ClasseController::class, 'liste_presence'])->name('presence.classe');
    Route::post('/classe/arrivee', [ClasseController::class, 'heure_arrivee'])->name('arrivee.classe');
    Route::put('/classe/depart/{id}', [ClasseController::class, 'heure_depart'])->name('depart.classe');
    Route::get('/admin/etudiant/{id}/show', [UserController::class, 'show'])->name('etudiant.show');
    Route::put('/admin/horaire/edit/{id}', [ClasseController::class, 'update_horaire'])->name('update.horaire');
    //calendrier coach
    Route::get('/classe/calendrier', [CalendrierController::class, 'index'])->name('calendrier.index');
    Route::get('/classe/calendrier/show/{id}', [CalendrierController::class, 'show'])->name('calendrier.show');
    Route::get('/classe/calendrier/pdf/{id}', [CalendrierController::class, 'getPDF'])->name('calendrier.pdf');

    // -----middleware ADMIN et PARTENAIRE
    Route::middleware(['admin_part'])->group(function () {
        //Formulaire molengeek
        Route::get('/admin/create/formulaire/molengeek/{id}', [ValidationController::class, 'formulaire_molengeek'])->name('validation.formulaire.molengeek');
        Route::post('/admin/store/formulaire/molengeek/{id}', [ValidationController::class, 'formulaire_molengeek_store'])->name('validation.formulaire.molengeek.store');
        Route::get('/admin/show/formulaire/molengeek/{id}', [ValidationController::class, 'formulaire_molengeek_show'])->name('view.formulaire.molengeek');
        Route::get('/admin/edit/formulaire/molengeek/{id}', [ValidationController::class, 'formulaire_molengeek_edit'])->name('edit.formulaire.molengeek');
        Route::put('/admin/update/formulaire/molengeek/{id}', [ValidationController::class, 'formulaire_molengeek_update'])->name('update.formulaire.molengeek');
        //Formulaire partenaire
        Route::get('/admin/create/formulaire/partenaire/{id}', [ValidationController::class, 'formulaire_partenaire'])->name('validation.formulaire.partenaire');
        Route::post('/admin/store/formulaire/partenaire/{id}', [ValidationController::class, 'formulaire_partenaire_store'])->name('validation.formulaire.partenaire.store');
        Route::get('/admin/show/formulaire/partenaire/{id}', [ValidationController::class, 'formulaire_partenaire_show'])->name('view.formulaire.partenaire');
        Route::get('/admin/edit/formulaire/partenaire/{id}', [ValidationController::class, 'formulaire_partenaire_edit'])->name('edit.formulaire.partenaire');
        Route::put('/admin/update/formulaire/partenaire/{id}', [ValidationController::class, 'formulaire_partenaire_update'])->name('update.formulaire.partenaire');
        // ETUDIANT
        Route::get('/admin/etudiant/all', [UserController::class, 'index'])->name('etudiant.index');
        Route::get('/admin/etudiant/candidat', [UserController::class, 'index_candidat'])->name('etudiant.index_candidat');
        Route::get('/admin/etudiant/etudiant', [UserController::class, 'index_etudiant'])->name('etudiant.index_etudiant');
        Route::get('/admin/etudiant/recherche', [UserController::class, 'search'])->name('search');
        // Route::get('/admin/etudiant/{id}/show', [UserController::class, 'show'])->name('etudiant.show');
        //COMMENTAIRE
        Route::post('/admin/etudiant/addcommentaire/{etudiant}', [UserController::class, 'addcomment'])->name('etudiant.addcom');
        Route::delete('/admin/etudiant/commentaire/{commentaire}/destroy', [UserController::class, 'destroy'])->name('etudiant.commentaire.destroy');

        // ----- middleware ADMIN
        Route::middleware('admin')->group(function () {
            //CLASSE
            Route::get('/admin/gestion',  [ClasseController::class, 'index_gestion'])->name('gestion.index');
            //Create
            Route::post('/admin/gestion/store', [ClasseController::class, 'store_classe'])->name('classe.store');
            Route::put('/admin/gestion/update/{user}', [ClasseController::class, 'etudiant_classe'])->name('etudiant.classe');
            //Show
            Route::get('/admin/gestion/{id}/show', [ClasseController::class, 'show_classe'])->name('classe.show');
            Route::get('/admin/gestion/archives', [ClasseController::class, 'archive'])->name('classe.archive');
            //edit
            Route::get('/admin/gestion/edit/{id}', [ClasseController::class, 'edit_classe'])->name('classe.edit');
            //update
            Route::put('/admin/gestion/update/classe/{id}', [ClasseController::class, 'update_classe'])->name('classe.update');
            // EVENTS
            //Communauté
            Route::delete('/formulaire/{id}/delete/choixmultiple/question', [DeleteForFormController::class, "destroyChoixMultiple"])->name("question.destroyChoixMultiple");
            // Condition:
            Route::get('/admin/condition/edit', [CondtitionController::class, 'edit'])->name('condition.edit');
            Route::put('/admin/condition/update', [CondtitionController::class, 'update'])->name('condition.update');
            // Materiel:
            Route::get('/admin/materiel', [MaterielController::class, 'index'])->name('materiel.index');
            Route::get('/admin/materiel/disponible', [MaterielController::class, 'index_disponible'])->name('materiel.index_disponible');
            Route::get('/admin/materiel/nondisponible', [MaterielController::class, 'index_nondisponible'])->name('materiel.index_nondisponible');
            Route::get('/admin/materiel/recherche', [MaterielController::class, 'search'])->name('materiel.search');
            Route::get('/admin/materiel/create', [MaterielController::class, 'create'])->name('materiel.create');
            Route::post('/admin/materiel/store', [MaterielController::class, 'store'])->name('materiel.store');
            Route::get('/admin/materiel/edit/{id}', [MaterielController::class, 'edit'])->name('materiel.edit');
            Route::put('/admin/materiel/update/{id}', [MaterielController::class, 'update'])->name('materiel.update');
            Route::put('/admin/materiel/update/{id}/student', [MaterielController::class, 'update_student'])->name('materiel.update.student');
            Route::get('/admin/materiel/view/{numero}', [MaterielController::class, 'view'])->name('materiel.view');
            Route::get('/classe/materiel/pdf/{id}', [MaterielController::class, 'getPDF'])->name('qrcode.pdf');

            // COMMUNAUTE
            Route::get('/admin/communauté', [CommunauteController::class, 'index'])->name('communaute.index');
            Route::get('/admin/communauté/write', [CommunauteController::class, 'write'])->name('communaute.write');
            Route::post('/admin/communauté/send', [CommunauteController::class, 'send'])->name('communaute.send');
            Route::get('/admin/communauté/search', [CommunauteController::class, 'search'])->name('communaute.search');
            Route::delete('/admin/communaute/delete/{id}', [CommunauteController::class, 'delete'])->name('communaute.destroy');
            Route::put('/admin/communaute/change/{id}', [CommunauteController::class, 'change'])->name('communauté.change');
            // EVENTS
            Route::get('/admin/event', [SeanceController::class, 'index'])->name('event.index');
            Route::get('/admin/event/archives', [SeanceController::class, 'archive'])->name('event.archive');
            Route::get('/admin/event/archives/{id}', [SeanceController::class, 'archive_tri'])->name('event.archive_tri');
            Route::get('/admin/event/{id}/etudiants/', [SeanceController::class, 'etudiants'])->name('event.etudiants');
            Route::get('/admin/event/{id}', [SeanceController::class, 'index_tri'])->name('event.index_tri');
            Route::put('/admin/event/fin/{id}', [SeanceController::class, 'finSeance'])->name('event.update');
            Route::put('/admin/event/presence/{id}/{seance}', [UserController::class, 'presence'])->name('event.update.presence');
            Route::put('/back/event/{user}/invitation_week', [SeanceController::class, 'invitation_week'])->name('event.invitation_week');
            Route::get('/admin/create/event', [EvenementController::class, 'create'])->name('event.create');
            Route::get('/admin/create/event/type', [EvenementController::class, 'createSecondStep'])->name('event.secondStep');
            Route::post('/admin/store/event', [EvenementController::class, 'store'])->name('event.store');
            Route::get('/admin/event/create/seance/{id}', [EvenementController::class, 'createSeance'])->name('seance.create');
            Route::post('/admin/store/seance', [EvenementController::class, 'storeSeance'])->name('seance.store');
            Route::get('/admin/edit/seance/{id}', [EvenementController::class, 'editSeance'])->name('seance.edit');
            Route::put('/admin/update/seance/{id}', [EvenementController::class, 'updateSeance'])->name('seance.update');
            Route::get('/admin/destroy/seance/{id}', [EvenementController::class, 'destroySeance'])->name('seance.destroy');
            Route::put('/admin/seance/cloture/{id}', [SeanceController::class, 'cloture'])->name('seance.cloture');
            //delete evenementtype 
            Route::delete('/admin/delete/{id}', [EvenementTypeController::class, 'softDelete'])->name('evenementtype.delete');
            // ETUDIANT
            Route::get('/admin/etudiant/edit/{id}', [UserController::class, 'edit'])->name('etudiant.edit');
            Route::put('/admin/etudiant/update/{id}', [UserController::class, 'update'])->name('etudiant.update');
            // Signature
            Route::get('/back/mail/signature/{id}/create', [MailController::class, 'create_signature'])->name('mail.signature.create');
            Route::put('/back/mail/signature/{id}/store', [MailController::class, 'store_signature'])->name('mail.signature.store');

            Route::get('/formulaire/created/{id}/database', [StoreFormController::class, "showDataForm"])->name('createdForm.showDataForm');

            Route::get('/formulaire/{id}/created/to/send', [MailFormController::class, "index"])->name("mailForm.index");
            Route::put('/formulaire/{id}/send/created/mail', [MailFormController::class, "store"])->name("mailForm.store");

            Route::delete('/formulaire/{formulaire}/{user}/destroy', [DeleteForFormController::class, "destroyDataForm"])->name('formulaire.destroyDataForm');
        });
    });
    Route::get('/formulaire/show/histo/for/student', [HistoFormController::class, 'index'])->name('histoform.index');
});
