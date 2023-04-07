<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\recette;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/recettes', function (Request $request) {
    $recettes = recette::where('ingredients','LIKE','%'.$request->search.'%') -> get();
 
return response()->json($recettes);
});

Route::delete('/sup/{id}', function ($id) {
    $recette = recette::find($id);
    $ok = $recette->delete();
    if ($ok) {
        return response()->json(["status" => 1, "message" => "Recette supprimé"],201);
        } else {
        return response()->json(["status" => 0, "message" => "pb lors de
       la suppresion"],400);
        }
       } );

       Route::put('modifier/{id}', function ($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'titre' => ['required','string'],
            'ingredients' => ['required','string'],
            'photo' => ['required','string'],
            'duree' => ['required','numeric'],
            ]);
            if ($validator->fails()) {
                return $validator->errors();
                }
        $recette = recette::find($id);// nouvel objet instance du modèle
    $recette->titre = $request->titre; 
    $recette->ingredients = $request->ingredients;
    $recette->photo = $request->photo;
    $recette->duree = $request->duree;
    $ok = $recette->save(); // sauvegarde dans la BD Insert into
    if ($ok) {
        return response()->json(["status" => 1, "message" => "Recette modifié"],201);
        } else {
        return response()->json(["status" => 0, "message" => "pb lors de
       la Modification"],400);
        }
       } );
