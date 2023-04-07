<?php

use Illuminate\Support\Facades\Route;
use App\Models\recette;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/accueil', function () {
    return view('accueil');
})->name('accueil');

Route::get('/liste_recette', function () {
    $recettes = recette::get();
    return view('liste_recette',["recettes"=>$recettes]);
})->name('liste_recette');

Route::get('/recherche', function (Request $request) {

    $recettes = recette::where('ingredients','LIKE','%'.$request->search.'%') -> get();
    return view('resultat_recherche', ["recettes"=>$recettes]);
})->name('recherche');


Route::get('/ajouter', function () {
    return view('ajout_recette');
})->name('ajouter');

Route::post('ajout', function (Request $request) {
    $recette = new recette; // nouvel objet instance du modèle
$recette->titre = $request->titre; 
$recette->ingredients = $request->ingredients;
$recette->photo = $request->photo;
$recette->duree = $request->duree; 
$recette->save(); // sauvegarde dans la BD Insert into
return view('accueil', ["message"=>'Recette ajouté']);

})->name('ajout');
