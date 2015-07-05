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
Route::get('/','UserController@accueil_page');

// Gérer des comptes des étudiants ==> Done
Route::get('compte/add','UserController@add_user_get');
Route::post('compte/add','UserController@add_user_post');
Route::get('compte/login','UserController@login_get');
Route::post('compte/login','UserController@login_post');
Route::get('compte/logout','UserController@logout');
Route::get('compte/show',['middleware' => 'auth', 'uses' => 'UserController@show_compte']);
Route::get('compte/update',['middleware' => 'auth', 'uses' => 'UserController@update_compte_get']);
Route::post('compte/update',['middleware' => 'auth', 'uses' => 'UserController@update_compte_post']);
Route::get('compte/reinitialyze‏','UserController@reinitialyze‏_password_get');
Route::post('compte/reinitialyze‏','UserController@reinitialyze‏_password_post');
//Gérer des comptes des autres (administrateur, professeur, secrétariat) => en cours
Route::get('admin/compte/add','UserController@admin_creerCompte');
Route::get('admin/compte/login','UserController@admin_seConnecter');
Route::get('admin/compte/logout','UserController@admin_seDeconnecter');
Route::get('admin/compte/show','UserController@admin_afficherProfil');
Route::get('admin/compte/update','UserController@admin_modifierProfil');
Route::get('admin/compte/reinitialyze‏','UserController@admin_reinitialiserMdp');
//Gérer des profils => Done
Route::get('admin/profil/add',['middleware' => 'auth', 'uses' => 'ProfilController@add_profil_get']);
Route::post('admin/profil/add',['middleware' => 'auth', 'uses' => 'ProfilController@add_profil_post']);
Route::get('admin/profil/update/{id}',['middleware' => 'auth', 'uses' => 'ProfilController@update_profil_get']);
Route::post('admin/profil/update/{id}',['middleware' => 'auth', 'uses' => 'ProfilController@update_profil_post']);
Route::get('admin/profil/delete/{id}',['middleware' => 'auth', 'uses' => 'ProfilController@delete_profil']);
Route::get('admin/profil/show',['middleware' => 'auth', 'uses' => 'ProfilController@show_profil']);
//Gérer des groupes => Done
Route::get('admin/groupe/add',['middleware' => 'auth', 'uses' => 'GroupeController@add_groupe_get']);
Route::post('admin/groupe/add',['middleware' => 'auth', 'uses' => 'GroupeController@add_groupe_post']);
Route::get('admin/groupe/update/{id}',['middleware' => 'auth', 'uses' => 'GroupeController@update_groupe_get']);
Route::post('admin/groupe/update/{id}',['middleware' => 'auth', 'uses' => 'GroupeController@update_groupe_post']);
Route::get('admin/groupe/delete/{id}',['middleware' => 'auth', 'uses' => 'GroupeController@delete_groupe']);
Route::get('admin/groupe/show',['middleware' => 'auth', 'uses' => 'GroupeController@show_groupe']);

//gestion des spécialités : en cours
Route::get('specialite/add', 'SpecialiteController@get_Create_Page'); // OK et testé
Route::post('specialite/add', 'SpecialiteController@post_Create'); // OK et testé

Route::post('specialite/list/update', 'SpecialiteController@post_Update_Page'); // à tester
Route::post('specialite/update/{id}', 'SpecialiteController@post_Update'); // à tester

Route::get('specialite/list', 'SpecialiteController@get_List_Page'); // à développer

//formulaire de concact : en cours => à parametrer @mail et à tester
Route::get('contact', 'ContactController@getForm');
Route::post('contact/form', 'ContactController@postForm');

//gestion des parcours : en cours à développer
Route::get('parcours/add', 'ParcoursController@get_Create_Page'); // à développer
Route::post('parcours/add', 'ParcoursController@post_Create');// à développer

Route::post('parcours/list/update', 'ParcoursController@post_Update_Page');// à développer
Route::post('parcours/update/{id}', 'ParcoursController@post_Update');// à développer

Route::get('parcours/list', 'ParcoursController@get_List_Page');// à développer
