<?php
/**
 * Created by PhpStorm.
 * User: HoangCao
 * Date: 01/07/2015
 * Time: 14:38
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class SpecialiteController extends Controller{

    //Fonction pour la page d'accueil
    public function accueil_page(){
        return view('specialiteCreation');
    }

    //Fonction pour page création de spécioalité
    public function get_Create_Page(){
        return view('specialiteCreation');
    }

    //Fonction pour page modifier spécialité
    public function get_Update_Page($id){
        return view('specialiteModification');
    }

    //Fonction pour créer spécialité
    public function post_Create(Request $request){
        $nom = $request->input('nom');
        //opération CRUD
        return "page de validation spécialité ajoutée";
    }

    //Fonction pour modifier spécialité
    public function post_Update(Request $request){
        $nom = $request->input('nom');
        //$id =
        //opération CRUD
        return "page de validation spécialité modifiée";
    }
    //Fonction pour supprimer spécialité
    public function Delete($id){
        //opération CRUD
        return "page de validation spécialité supprimée";
    }

}