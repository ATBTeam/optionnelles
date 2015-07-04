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
// Gérer des comptes des étudiants
Route::get('/','UserController@accueil_page');
Route::get('compte/creer','UserController@creerCompte_get');
Route::post('compte/creer','UserController@creerCompte_post');
Route::get('compte/seConnecter','UserController@seConnecter_get');
Route::post('compte/seConnecter','UserController@seConnecter_post');
Route::get('compte/seDeconnecter','UserController@seDeconnecter');
Route::get('compte/afficher',['middleware' => 'auth', 'uses' => 'UserController@afficherProfil']);
Route::get('compte/modifier',['middleware' => 'auth', 'uses' => 'UserController@modifierProfil']);
Route::get('compte/reinitialiser','UserController@reinitialiserMdp');
//Gérer des comptes des autres (administrateur, professeur, secrétariat)
Route::get('admin/compte/creer','UserController@admin_creerCompte');
Route::get('admin/compte/seConnecter','UserController@admin_seConnecter');
Route::get('admin/compte/seDeconnecter','UserController@admin_seDeconnecter');
Route::get('admin/compte/afficher','UserController@admin_afficherProfil');
Route::get('admin/compte/modifier','UserController@admin_modifierProfil');
Route::get('admin/compte/reinitialiser','UserController@admin_reinitialiserMdp');

//gestion des spécialités : en cours
Route::get('specialite/create', 'SpecialiteController@get_Create_Page');
Route::post('specialite/create', 'SpecialiteController@post_Create');

Route::get('specialite/update', 'SpecialiteController@get_Update_Page');
Route::post('specialite/update', 'SpecialiteController@post_Update');

//formulaire de concact
Route::get('contact', 'ContactController@getForm');
Route::post('contact/form', 'ContactController@postForm');