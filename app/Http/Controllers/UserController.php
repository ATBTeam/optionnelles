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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Validator;
use App\Specialite;


class UserController extends Controller{

    //Fonction pour la page d'accueil
    public function accueil_page(){
        return "page accueil";
    }

    //Etudiant
    //Fonction pour creer un compte ==> Done
    public function add_user_get(){
        try{
            $parcours = DB::table('parcours')->get();
        }catch (Exception $e){
            return "Erreur !!";
        }
        return response()->view('auth/register', ['parcours' => $parcours]);
    }
    public function add_user_post(Request $request){
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
        return redirect('compte/login');
    }

    //Fonction pour se connecter ==> Done
    public function login_get(){
        return response()->view('auth/login');
    }
    public function login_post(Request $request){
        $this->validate($request, [
            'login' => 'required|exists:user,login|min:8',
            'mdp' => 'required|min:8|exists:user,mdp'
        ]);

        $user = User::where('login', $request->input('login'))->get()->first();
        if ($user->actif == 1){
            Auth::login($user);
            switch($user->profil->intitule){
                case 'administrateur': return "Page acceuil pour un administrateur";
                case 'professeur': return "Page acceuil pour un professeur";
                case 'secrétariat': return "Page acceuil pour un secrétariat";
                case 'étudiant': return "Page acceuil pour un étudiant";
            }
        }else{
            return response()->view('auth/login', ['actif'=> $user->actif]);
        }
    }

    //Fonction pour se deconnecter  ==> Done
    public function logout(){
        Auth::logout();
        return "page pour se deconnecter";
    }

    //Fonction pour afficher profil ==> Done
    public function show_compte(){
        if (Auth::check())
        {
            $user = Auth::user();
            return response()->view('auth/show_compte', ['user'=> $user]);
        }
    }

    //Fonction pour modifier profil ==> Done
    public function update_compte_get(){
        if (Auth::check())
        {
            $user = Auth::user();
            return response()->view('auth/update_compte', ['user'=> $user]);
        }
    }
    public function update_compte_post(Request $request){
        $erreurs = new Collection();
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'mail' => 'required',
            'login' => 'required|min:8',
            'mdp1' => 'required|min:8',
            'mdp2' => 'required|min:8',
        ]);

        $user = Auth::user();
        $users = User::all();

        foreach($users as $u){
            if($request->input('login') != $user->login){
                if($request->input('login') == $u->login){
                    $erreurs->prepend("Ce login existe déjà !");
                    break;
                }
            }
        }

        foreach($users as $u){
            if($request->input('mail') != $user->mail){
                if($request->input('mail') == $u->mail){
                    $erreurs->prepend("Cet email existe déjà !");
                    break;
                }
            }
        }

        if($request->input('mdp1')!=$user->mdp ){
            $erreurs->prepend("Votre mot de passe n'est pas valide");
        }

        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->mail = $request->input('mail');
        $user->login =  $request->input('login');
        $user->mdp = $request->input('mdp2');

        if(count($erreurs) > 0){
            return response()->view('auth/update_compte', ['user'=> $user, 'erreurs'=>$erreurs]);
        }

        $user->save();
        if ($user->profil->intitule != "étudiant")
            return redirect('admin/compte/show');
        else return redirect('compte/show');
    }

    //Fonction pour reinitialiser mot de passe
    public function reinitialyze_password_get(){
        return Specialite::find(1);
        return "page pour reinitialiser mot de passe";
    }


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //Autres : Professeur, administrateur, secrétariat
    //Fonction pour creer un compte
    //Fonction pour creer un compte ==> Done
    public function admin_add_user_get(){
        try{
            $profils = DB::table('profil')
                ->whereNotIn('intitule', ['étudiant', 'administrateur'])
                ->get();
        }catch (Exception $e){
            return "Erreur !!";
        }
        return response()->view('auth/admin_register', ['profils' => $profils]);
    }
    public function admin_add_user_post(Request $request){
        $this->validate($request, [
            'nom' => 'required',
            'prenom' => 'required',
            'mail' => 'required|unique:user',
            'login' => 'required|unique:user|min:8',
            'mdp1' => 'required|min:8|same:mdp2',
            'mdp2' => 'required|min:8',
            'profil' => 'exists:profil,id'
        ]);

        $user = new User;
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->mail = $request->input('mail');
        $user->login =  $request->input('login');
        $user->mdp = $request->input('mdp1');
        $user->actif = false;
        $user->parcours_id = $request->input('parcours');
        $user->profil_id = $request->input('profil');
        $user->save();
        return redirect('compte/login');
    }

    //Fonction pour afficher compte ==> Done
    public function admin_show_compte(){
        if (Auth::check())
        {
            $user = Auth::user();
            return response()->view('auth/admin_show_compte', ['user'=> $user]);
        }
    }
}