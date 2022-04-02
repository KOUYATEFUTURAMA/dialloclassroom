<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

Route::get('liste-cours', 'Api\CourController@listeCours');
Route::get('liste-cours-by-libelle/{libelle}', 'Api\CourController@listeCoursByLibelle');
Route::get('liste-cours-by-mode/{mode}', 'Api\CourController@listeCoursByMode');
Route::get('liste-cours-by-categorie/{categorie}', 'Api\CourController@listeCoursByCategorie');
Route::get('liste-cours-by-mode-categorie/{mode}/{categorie}', 'Api\CourController@listeCoursByModeCategorie');



