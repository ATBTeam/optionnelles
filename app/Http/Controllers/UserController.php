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


class UserController extends Controller{

    //Fonction pour la page d'accueil
    public function accueil_page(){
        return "page accueil";
    }

    //Fonction pour creer un compte
    public function creerCompte(){
        return "page pour créer un compte";
    }

    //Fonction pour se connecter
    public function seConnecter(Request $request){
        if ($request->isMethod('post')) {

            return "post";
        }
        return response()->view('auth/login');
    }

    //Fonction pour se deconnecter  ==> Done
    public function seDeconnecter(Request $request){
        Auth::logout();
        return "page pour se deconnecter";
    }

    //Fonction pour afficher profil
    public function afficherProfil(Request $request){
        return "page pour afficher profil";
    }

    //Fonction pour modifier profil
    public function modifierProfil(Request $request){
        return "page pour modifier profil";
    }
    //Fonction pour reinitialiser mot de passe
    public function reinitialiserMdp(){
        return "page pour reinitialiser mot de passe";
    }

}