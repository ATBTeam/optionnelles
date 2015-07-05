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
Route::get('specialite/add', 'SpecialiteController@get_Create_Page'); // OK et testé
Route::post('specialite/add', 'SpecialiteController@post_Create'); // OK et testé

Route::post('specialite/list/update', 'SpecialiteController@get_Update_Page'); // à tester
Route::post('specialite/update/{id}', 'SpecialiteController@post_Update'); // à tester

Route::get('specialite/list', 'SpecialiteController@get_List_Page'); // à développer

//formulaire de concact : en cours => à parametrer @mail et à tester
Route::get('contact', 'ContactController@getForm');
Route::post('contact/form', 'ContactController@postForm');

//gestion des parcours : en cours à développer
Route::get('parcours/add', 'ParcoursController@get_Create_Page'); // à développer
Route::post('parcours/add', 'ParcoursController@post_Create');// à développer

Route::get('parcours/update', 'ParcoursController@get_Update_Page');// à développer
Route::post('parcours/update/{id}', 'ParcoursController@post_Update');// à développer

Route::get('parcours/list', 'ParcoursController@get_Update_Page');// à développer