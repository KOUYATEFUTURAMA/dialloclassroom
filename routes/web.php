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

Route::get('/', function () {
    return view('front-end.index');
});
Route::get('/page-admin', function () {
    return view('auth.login');
});
Route::get('/confirm-compte', function () {
    return view('auth.confirm');
});

Route::post('/confirm-compte', 'Auth\LoginController@confirmCompte')->name('confirm-compte');
Route::post('/ask-password', 'Auth\ResetPasswordController@askPassword')->name('ask-password');

Auth::routes();
Route::get('/home-admin', 'HomeController@admin')->name('home.admin');
Route::get('/home-client', 'HomeController@client')->name('home.client');

//les routes du module Parametre
Route::namespace('Parametre')->middleware('auth')->name('parametre.')->prefix('parametre')->group(function () {
    //Categories
    Route::resource('categories', 'CategorieController');
    Route::get('liste-categories', 'CategorieController@listeCategorie');
    Route::get('categorie-blog', 'CategorieController@categorieBlog')->name('categorie-blog');
    Route::get('listes-categories-blog', 'CategorieController@listeCategorieBlog');

    //Modes 
    Route::resource('modes', 'ModeController');
    Route::get('liste-modes', 'ModeController@listeMode');
});

//les routes du module Education
Route::namespace('Education')->middleware('auth')->name('education.')->prefix('education')->group(function () {
    //Enseignants
    Route::resource('enseignants', 'EnseignantController');
    Route::get('liste-enseignants', 'EnseignantController@listeEnseignant');

    //Cours
    Route::resource('cours', 'CourController');
    Route::get('liste-cours/{libelle?}', 'CourController@listeCours');
    Route::get('liste-cours-by-mode/{mode}', 'CourController@listeCoursByMode');
    Route::get('liste-cours-by-categorie/{categorie}', 'CourController@listeCoursByCategorie');
    Route::get('liste-cours-by-mode-categorie/{mode}/{categorie}', 'CourController@listeCoursByModeCategorie');

    //Blogs
    Route::resource('blogs', 'BlogController');
    Route::get('liste-blogs/{titre?}', 'BlogController@listeBlog');
    Route::get('liste-blogs-by-categorie/{categorie}', 'BlogController@listeBlogByCategorie');
    Route::post('ckeditor', 'BlogController@ckeditorUpload')->name('ckeditor.upload');

    //Reservations 
    Route::resource('reservations', 'ReservationController');
    Route::get('achats', 'ReservationController@achatVue')->name('reservations.achat');
    Route::get('liste-reservations', 'ReservationController@listeReservation');
    Route::get('liste-achats', 'ReservationController@listeAchat');
});

//les routes du module Site
Route::namespace('Site')->middleware('auth')->name('site.')->prefix('site')->group(function () {
    Route::resource('comments', 'CommentController');
    Route::get('liste-comments', 'CommentController@listeComment');

    Route::resource('messages', 'MessageController');
    Route::get('liste-messages', 'MessageController@listeMessage');

    Route::resource('sliders', 'SliderController');
    Route::get('liste-sliders', 'SliderController@listeSlider');

    Route::resource('videos', 'VideoController');
    Route::get('liste-videos', 'VideoController@listeVideo');
});


//les routes du module Auth
Route::namespace('Auth')->middleware('auth')->name('auth.')->prefix('auth')->group(function () {

    Route::get('users', 'UserController@index')->name('user.index');
    Route::post('action', 'UserController@action')->name('user.action');
    Route::get('user-profil', 'UserController@profil')->name('user.profil');
    Route::put('update-profil/{user}', 'UserController@updateProfil')->name('user.update-profil');
    Route::put('update-password/{user}', 'UserController@updatePassword')->name('user.update-password');
    Route::delete('delete-user/{user}', 'UserController@delete');

    //Route pour les listes dans boostrap table
    Route::get('liste-users', 'UserController@listeUser')->name('liste-users');
});

//Les routes du site
Route::get('/', 'WebController@index')->name('web.index');
Route::get('/about', 'WebController@about')->name('web.about');
Route::get('/cours', 'WebController@cours')->name('web.cours');
Route::get('/blogs', 'WebController@blogs')->name('web.blogs');
Route::get('/galeries', 'WebController@galeries')->name('web.galeries');
Route::get('/contact', 'WebController@contact')->name('web.contact');
Route::get('/site-login', 'WebController@login')->name('web.site-login');
Route::get('/site-register', 'WebController@register')->name('web.site-register');

Route::post('/retour-payement-success', 'WebController@retourPayementSuccess');

Route::get('{slug}_c{id}.html', 'WebController@cour')->name('web.cours-details');
Route::get('{slug}_b{id}.html', 'WebController@blog')->name('web.blog-details');
Route::get('{slug}_a{id}.html', 'WebController@achatCour')->name('web.achat-cour');

Route::post('comment/store', 'WebController@commentStore')->name('comment.store');
Route::post('message/store', 'WebController@messageStore')->name('message.store');
