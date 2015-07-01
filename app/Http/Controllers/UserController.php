<?php
/**
 * Created by PhpStorm.
 * User: HoangCao
 * Date: 01/07/2015
 * Time: 14:38
 */

namespace App\Http\Controllers;

use App\User;


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
    public function seConnecter(){
        return "page pour se connecter";
    }

    //Fonction pour se deconnecter
    public function seDeconnecter(){
        return "page pour se deconnecter";
    }

    //Fonction pour afficher profil
    public function afficherProfil(){
        return "page pour afficher profil";
    }

    //Fonction pour modifier profil
    public function modifierProfil(){
        return "page pour modifier profil";
    }
    //Fonction pour reinitialiser mot de passe
    public function reinitialiserMdp(){
        return "page pour reinitialiser mot de passe";
    }

}