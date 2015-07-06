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
Route::get('compte/register','UserController@register_get');
Route::post('compte/register','UserController@register_post');
Route::get('compte/login','UserController@login_get');
Route::post('compte/login','UserController@login_post');
Route::get('compte/logout','UserController@logout');
Route::get('compte/show',['middleware' => 'auth', 'uses' => 'UserController@show_compte_get']);
Route::post('compte/show',['middleware' => 'auth', 'uses' => 'UserController@show_compte_post']);
Route::get('compte/update',['middleware' => 'auth', 'uses' => 'UserController@update_compte_get']);
Route::post('compte/update',['middleware' => 'auth', 'uses' => 'UserController@update_compte_post']);
Route::get('compte/reinitialyze‏','UserController@reinitialyze‏_password_get');
Route::post('compte/reinitialyze‏','UserController@reinitialyze‏_password_post');
//Gérer des comptes des autres (administrateur, professeur, secrétariat) => en cours
Route::get('admin/compte/register','UserController@admin_register_get');
Route::post('admin/compte/register','UserController@admin_register_post');
//Route::get('admin/compte/login','UserController@login_get');
//Route::post('admin/compte/login','UserController@login_post');
//Route::get('admin/compte/logout','UserController@logout');
//Route::get('admin/compte/show',['middleware' => 'auth', 'uses' => 'UserController@admin_show_compte']);
//Route::get('admin/compte/update',['middleware' => 'auth', 'uses' => 'UserController@update_compte_get']);
//Route::post('admin/compte/update',['middleware' => 'auth', 'uses' => 'UserController@update_compte_post']);
Route::get('admin/compte/reinitialyze‏','UserController@reinitialyze‏_password_get');
Route::post('admin/compte/reinitialyze‏','UserController@reinitialyze‏_password_post');
//Gérer des utilisateurs => Done
Route::get('admin/user/show',['middleware' => 'auth', 'uses' => 'UserController@show_all_user']);
Route::get('admin/user/add',['middleware' => 'auth', 'uses' => 'UserController@add_user_get']);
Route::post('admin/user/add',['middleware' => 'auth', 'uses' => 'UserController@add_user_post']);
Route::get('admin/user/delete/{id}',['middleware' => 'auth', 'uses' => 'UserController@delete_user']);
Route::get('admin/user/update/{id}',['middleware' => 'auth', 'uses' => 'UserController@update_user_get']);
Route::post('admin/user/update/{id}',['middleware' => 'auth', 'uses' => 'UserController@update_user_post']);
Route::get('admin/user/active/{id}',['middleware' => 'auth', 'uses' => 'UserController@active_user']);
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

//formulaire de concact : OK et testé => paramétrer la bonne @mail de l'admin dans le controler, config\mail.php, .env (server smtp)
Route::get('contact', 'ContactController@getForm');//OK et testé
Route::post('contact/form', 'ContactController@postForm'); // OK et testé

//gestion des spécialités : en cours => ajouter restriction user (admin seulement) TODO (Thomas, work in progress)
Route::get('specialite/add', 'SpecialiteController@get_Create_Page'); // OK et testé
Route::post('specialite/add', 'SpecialiteController@post_Create'); // OK et testé
Route::post('specialite/list/update', 'SpecialiteController@post_Update_Page'); // OK et testé
Route::post('specialite/update/{id}', 'SpecialiteController@post_Update'); // OK et testé
Route::post('specialite/list/delete', 'SpecialiteController@post_Delete_Page'); // OK et testé
Route::post('specialite/deleteCancel', 'SpecialiteController@post_DeleteCancel'); // OK et testé
Route::post('specialite/deleteConfirm/{id}', 'SpecialiteController@post_DeleteConfirm'); // OK et testé
Route::get('specialite/list', 'SpecialiteController@get_List_Page'); // OK et testé

//gestion des parcours : en cours => ajouter restriction user (admin seulement) TODO (Thomas, work in progress)
Route::get('parcours/add', 'ParcoursController@get_Create_Page'); // OK et testé
Route::post('parcours/add', 'ParcoursController@post_Create');// OK et testé
Route::post('parcours/list/update', 'ParcoursController@post_Update_Page');// OK et testé
Route::post('parcours/update/{id}', 'ParcoursController@post_Update');// OK et testé
Route::post('parcours/list/delete', 'ParcoursController@post_Delete_Page'); // OK et testé
Route::post('parcours/deleteCancel', 'ParcoursController@post_DeleteCancel'); // OK et testé
Route::post('parcours/deleteConfirm/{id}', 'ParcoursController@post_DeleteConfirm'); // OK et testé
Route::get('parcours/list', 'ParcoursController@get_List_Page');// OK et testé

// Gestion des UEs : TODO (Florian, work in progress)
Route::get('ue', 'UesController@index');
Route::get('ue/create', 'UesController@create');
Route::get('ue/{ue}', 'UesController@show');
Route::post('ue', 'UesController@store');
Route::get('ue/{ue}/edit', 'UesController@edit');
Route::patch('ue/{ue}', 'UesController@update');

// Gestion des Choix : TODO (work in progress)
Route::get('choix', 'ChoixController@index');
Route::get('choix/choisir', 'ChoixController@create');
Route::get('compte/choix', 'ChoixController@meschoix');
