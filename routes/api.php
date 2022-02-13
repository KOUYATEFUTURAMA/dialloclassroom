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

Route::post('signup', 'Api\JeuneController@signup');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('ask-password', 'Api\AuthController@askPassword');

    Route::group(['middleware' => 'auth:api'], function() {
        //Infos pour la modification et la modification du profil jeune
        Route::get('get-users-infos', 'Api\JeuneController@getUserInfos');
        Route::put('update/{id}', 'Api\JeuneController@update');

        //Se déconnecter
        Route::get('logout', 'Api\AuthController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    //Astuces
    Route::get('liste-astuces/{libelle?}', 'Api\AstuceController@listeAstuce');
    Route::get('liste-astuces-by-theme/{theme}', 'Api\AstuceController@listeAstuceByTheme');
});

