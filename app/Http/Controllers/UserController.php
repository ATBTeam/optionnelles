<?php
/**
 * Created by PhpStorm.
 * User: HoangCao
 * Date: 01/07/2015
 * Time: 14:38
 */

namespace App\Http\Controllers;

use App\Enseigner;
use App\Groupe;
use App\Ue;
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
        $user = Auth::user();
        if(isset($user))
        {
            switch($user->profil->intitule){
                case 'administrateur': return response()->view('accueil/accueilAdmin');
                case 'professeur': return response()->view('accueil/accueilProf');
                case 'secrétariat': return response()->view('accueil/accueilSecr');
                case 'étudiant': return response()->view('accueil/accueilEtud');
                default : return response()->view('accueil/accueilEtud');
            }
        }
        return response()->view('accueil/accueilEtud');
    }

    //Etudiant
    //Fonction pour creer un compte ==> Done
    public function register_get(){
        try{
            $parcours = DB::table('parcours')->get();
        }catch (Exception $e){
            return "Erreur !!";
        }
        return response()->view('auth/register', ['parcours' => $parcours]);
    }
    public function register_post(Request $request){
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
                case 'administrateur': return response()->view('accueil/accueilAdmin');
                case 'professeur': return response()->view('accueil/accueilProf');
                case 'secrétariat': return response()->view('accueil/accueilSecr');
                case 'étudiant': return response()->view('accueil/accueilEtud');
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
    public function show_compte_get(){
        if (Auth::check())
        {
            $user = Auth::user();
            return response()->view('auth/show_compte', ['user'=> $user]);
        }
    }
    public function show_compte_post(){
        if (Auth::check())
        {
            return redirect('compte/update');
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

        return redirect('compte/show');
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
    public function admin_register_get(){
        try{
            $profils = DB::table('profil')
                ->whereNotIn('intitule', ['étudiant', 'administrateur'])
                ->get();
        }catch (Exception $e){
            return "Erreur !!";
        }
        return response()->view('auth/admin_register', ['profils' => $profils]);
    }
    public function admin_register_post(Request $request){
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

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Fonction pour afficher users ==> Done
    public function show_all_user(){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $users = User::all();
            return response()->view('auth/show_all_user', ['users' => $users]);
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour ajouter un nouveau utilisateur ==> Done
    public function add_user_get(){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $parcours = Parcours::all();
            $profils = Profil::all();
            $groupes = Groupe::all();
            $ues = Ue::all();
            return response()->view('auth/add_user',
                [
                    'parcours'=>$parcours,
                    'profils'=>$profils,
                    'groupes'=>$groupes,
                    'ues'=>$ues
                ]);
        }
        return "Vous êtes pas administrateur";
    }
    public function add_user_post(Request $request){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
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
            if($request->input('actif')==1)
                $user->actif = $request->input('actif');
            if($request->input('parcours') != 0)
                $user->parcours_id = $request->input('parcours');
            if($request->input('groupe') != 0){
                $user->groupe_id = $request->input('groupe');
                $user->parcours_id = Groupe::find($request->input('groupe'))->parcours->id;
            }
            if($request->input('profil') != 0)
                $user->profil_id = $request->input('profil');
            $user->save();
            if(count($request->input('ues')) > 0){
                foreach($request->input('ues') as $ue_id){
                    $enseigner = new Enseigner();
                    $enseigner->user_id = $user->id;
                    $enseigner->ue_id = $ue_id;
                    $enseigner->save();
                }
            }
            return redirect('admin/user/show');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour modifier un user ==> Done
    public function update_user_get($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $parcours = Parcours::all();
            $profils = Profil::all();
            $groupes = Groupe::all();
            $ues = Ue::all();
            $user = User::find($id);
            return response()->view('auth/update_user',
                [
                    'parcours'=>$parcours,
                    'profils'=>$profils,
                    'groupes'=>$groupes,
                    'ues'=>$ues,
                    'user'=> $user
                ]);
        }
        return "Vous êtes pas administrateur";
    }
    public function update_user_post(Request $request, $id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $erreurs = new Collection();
            $this->validate($request, [
                'nom' => 'required',
                'prenom' => 'required',
                'mail' => 'required',
                'login' => 'required|min:8',
                'mdp2' => 'required|min:8',
                'profil' => 'exists:profil,id'
            ]);

            $user = User::find($id);
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

            $user->parcours_id=null;
            $user->groupe_id = null;
            $user->profil_id = null;

            $user->nom = $request->input('nom');
            $user->prenom = $request->input('prenom');
            $user->mail = $request->input('mail');
            $user->login =  $request->input('login');
            $user->mdp = $request->input('mdp2');
            if($request->input('actif')==1)
                $user->actif = $request->input('actif');
            else
                $user->actif = 0;
            if($request->input('parcours') != 0)
                $user->parcours_id = $request->input('parcours');

            if($request->input('groupe') != 0){
                $user->groupe_id = $request->input('groupe');
                $user->parcours_id = Groupe::find($request->input('groupe'))->parcours->id;
            }

            if(count($erreurs) > 0){
                $parcours = Parcours::all();
                $profils = Profil::all();
                $groupes = Groupe::all();
                $ues = Ue::all();
                return response()->view('auth/update_compte', [
                    'erreurs'=>$erreurs,
                    'parcours'=>$parcours,
                    'profils'=>$profils,
                    'groupes'=>$groupes,
                    'ues'=>$ues,
                    'user'=> $user
                ]);
            }

            if($request->input('profil') != 0)
                $user->profil_id = $request->input('profil');
            $user->save();

            if(count($request->input('ues')) > 0){
                $user->uesEnseignees()->detach();
                foreach($request->input('ues') as $ue_id){
                    $enseigner = new Enseigner();
                    $enseigner->user_id = $user->id;
                    $enseigner->ue_id = $ue_id;
                    $enseigner->save();
                }
            }
            return redirect('admin/user/show');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour supprimer un user => Done
    public function delete_user($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user/show');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour activer un user et lui envoyer une notification par mail => Done
    public function active_user($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $user = User::find($id);
            if($user->actif==0)
                $user->actif = 1;
            else $user->actif = 0;
            $user->save();
            //Enovyer une notification par mail au utilisateur


            return redirect('admin/user/show');
        }
        return "Vous êtes pas administrateur";
    }
}