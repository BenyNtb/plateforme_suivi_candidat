<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfilController;
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

//voir autres dates 
Route::get('/date/{id}', [FrontController::class, 'showDate'])->name('date.index');
Route::get('/description/{id}', [FrontController::class, 'description'])->name('seance.description');

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
    //profil
    Route::put('/back/profil/communaute', [ProfilController::class, 'communaute'])->name('form.communaute');
    Route::get('/back/profil/{id}/edit', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/back/profil/{id}/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::get('/back/profil/seances', [ProfilController::class, 'seance'])->name('seance.index');
    Route::get('/back/profil/seances/etape-interview/{id}/{seance}', [SeanceController::class, "inscriptionItw"])->name('inscription.date');
    Route::post('/back/profil/seances/interview/{id}', [SeanceController::class, "storeEtape"])->name('inscription.interview');
    Route::get('/back/annulation/seance/{id}', [ProfilController::class, 'seanceDelete'])->name('seance.cancel');


});
