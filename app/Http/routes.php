<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/','SpecialiteController@accueil_page');

Route::get('compte/creer','UserController@creerCompte');

Route::get('compte/seConnecter','UserController@seConnecter');

Route::get('compte/seDeconnecter','UserController@seDeconnecter');

Route::get('compte/afficher','UserController@afficherProfil');

Route::get('compte/modifier','UserController@modifierProfil');

Route::get('compte/reinitialiser','UserController@reinitialiserMdp');

//gestion des spécialités : en cours
Route::get('specialite/create', 'SpecialiteController@get_Create_Page');
Route::post('specialite/create', 'SpecialiteController@post_Create');

Route::get('specialite/update', 'SpecialiteController@get_Update_Page');
Route::post('specialite/update', 'SpecialiteController@post_Update');

//formulaire de concact
Route::controller('contact', 'ContactController');