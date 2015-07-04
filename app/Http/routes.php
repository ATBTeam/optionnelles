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
Route::get('compte/add','UserController@creerCompte_get');
Route::post('compte/add','UserController@creerCompte_post');
Route::get('compte/login','UserController@seConnecter_get');
Route::post('compte/login','UserController@seConnecter_post');
Route::get('compte/logout','UserController@seDeconnecter');
Route::get('compte/show',['middleware' => 'auth', 'uses' => 'UserController@afficherProfil']);
Route::get('compte/update',['middleware' => 'auth', 'uses' => 'UserController@modifierProfil_get']);
Route::post('compte/update',['middleware' => 'auth', 'uses' => 'UserController@modifierProfil_post']);
Route::get('compte/reinitialyze‏','UserController@reinitialiserMdp');
//Gérer des comptes des autres (administrateur, professeur, secrétariat)
Route::get('admin/compte/add','UserController@admin_creerCompte');
Route::get('admin/compte/login','UserController@admin_seConnecter');
Route::get('admin/compte/logout','UserController@admin_seDeconnecter');
Route::get('admin/compte/show','UserController@admin_afficherProfil');
Route::get('admin/compte/update','UserController@admin_modifierProfil');
Route::get('admin/compte/reinitialyze‏','UserController@admin_reinitialiserMdp');

//gestion des spécialités : en cours
Route::get('specialite/add', 'SpecialiteController@get_Create_Page');
Route::post('specialite/add', 'SpecialiteController@post_Create');

Route::get('specialite/update', 'SpecialiteController@get_Update_Page');
Route::post('specialite/update/{id}', 'SpecialiteController@post_Update');

//formulaire de concact
Route::get('contact', 'ContactController@getForm');
Route::post('contact/form', 'ContactController@postForm');