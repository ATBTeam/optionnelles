<?php
/**
 * Created by PhpStorm.
 * User: HoangCao
 * Date: 01/07/2015
 * Time: 14:38
 */

namespace App\Http\Controllers;

use App\User;
use App\Profil;
use App\Parcours;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Validator;


class UserController extends Controller{

    //Fonction pour la page d'accueil
    public function accueil_page(){
        return "page accueil";
    }

    //Etudiant
    //Fonction pour creer un compte => Done
    public function creerCompte_get(){
        try{
            $parcours = DB::table('parcours')->get();
        }catch (Exception $e){
            return "Erreur !!";
        }
        return response()->view('auth/register', ['parcours' => $parcours]);
    }
    public function creerCompte_post(Request $request){
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'mail' => 'required|unique:user',
            'login' => 'required|unique:user|min:8',
            'mdp1' => 'required|min:8|same:mdp2',
            'mdp2' => 'required|min:8',
            'parcours' => 'exists:parcours,id'
        ]);

        $user = new User;
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->mail = $request->input('mail');
        $user->login =  $request->input('login');
        $user->mdp = $request->input('mdp1');
        $user->actif = false;
        $user->parcours_id = $request->input('parcours');
        $profil = Profil::where('intitule', 'étudiant')->get()->first();
        $user->profil_id = $profil->id;
        $user->save();
        return redirect('compte/seConnecter');
    }

    //Fonction pour se connecter => Done
    public function seConnecter_get(){
        return response()->view('auth/login');
    }
    public function seConnecter_post(Request $request){
        $this->validate($request, [
            'login' => 'required|exists:user,login|min:8',
            'mdp' => 'required|min:8|exists:user,mdp'
        ]);

        $user = User::where('login', $request->input('login'))->get()->first();
        if ($user->actif == 1){
            Auth::login($user);
            return redirect('/');
        }else{
            return response()->view('auth/login', ['actif'=> $user->actif]);
        }
    }

    //Fonction pour se deconnecter  ==> Done
    public function seDeconnecter(){
        Auth::logout();
        return "page pour se deconnecter";
    }

    //Fonction pour afficher profil
    public function afficherProfil(){
        if (Auth::check())
        {
            $user = Auth::user();
            return response()->view('auth/afficher_profil', ['user'=> $user]);
        }
    }

    //Fonction pour modifier profil
    public function modifierProfil(Request $request){
        return "page pour modifier profil";
    }
    //Fonction pour reinitialiser mot de passe
    public function reinitialiserMdp(){
        return "page pour reinitialiser mot de passe";
    }

    //Autres : Professeur, administrateur, secrétariat
    //Fonction pour creer un compte
    public function admin_creerCompte(Request $request){
        if ($request->isMethod('post')) {
            return "post admin";
        }
        return response()->view('auth/admin_register');
    }

    //Fonction pour se connecter
    public function admin_seConnecter(Request $request){
        if ($request->isMethod('post')) {
            return "post";
        }
        return response()->view('auth/admin_login');
    }

    //Fonction pour se deconnecter  ==> Done
    public function admin_seDeconnecter(Request $request){
        Auth::logout();
        return "page pour se deconnecter amdin";
    }

    //Fonction pour afficher profil
    public function admin_afficherProfil(Request $request){
        return "page pour afficher profil amdin";
    }

    //Fonction pour modifier profil
    public function admin_modifierProfil(Request $request){
        return "page pour modifier profil admin";
    }
    //Fonction pour reinitialiser mot de passe
    public function admin_reinitialiserMdp(){
        return "page pour reinitialiser mot de passe admin";
    }

}