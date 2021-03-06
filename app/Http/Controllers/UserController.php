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
use Mail;
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
                case 'professeur': return redirect('listes_emargement/ue');
                case 'secrétariat': return redirect('listes_emargement/ue');
                case 'étudiant': return response()->view('accueil/accueilEtud');
                default : return response()->view('accueil/accueilVisit');
            }
        }
        return response()->view('accueil/accueilVisit');
    }

    function sendValidationMail($id)
    {
        $user = User::FindOrFail($id);
        $mail = $user->mail;

        Mail::send('emails.activation', ['test'=>'test'], function($message) use($mail)
        {
            $message->to($mail)->subject('Activation de compte'); //modifier addresse attention erreur ->to
        });

        return null;
    }

    function sendPWDMail($user)
    {
        $mail = $user->mail;
        $url = url("compte/reinitialyze/".$user->id);

        Mail::send('emails.password', ['url'=> url($url)], function($message) use($mail)
        {
            $message->to($mail)->subject('changement de Mot de passe'); //modifier addresse attention erreur ->to
        });

        return null;
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
            'nom' => 'required|max:50',
            'prenom' => 'required|max:50',
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
        return redirect('login');
    }

    //Fonction pour se connecter ==> Done
    public function login_get(){
        if(Auth::check()) {
            switch(Auth::user()->profil->intitule){
                case 'administrateur': return redirect('/');
                case 'professeur': return redirect('/');
                case 'secrétariat': return redirect('/');
                case 'étudiant': return redirect('/');
                default : return response()->view('Auth/login');
            }
        }
        return response()->view('Auth/login');
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
                case 'administrateur': return redirect('/');
                case 'professeur': return redirect('/');
                case 'secrétariat': return redirect('/');
                case 'étudiant': return redirect('/');
            }
        }else{
            return response()->view('auth/login', ['actif'=> $user->actif]);
        }
    }

    //Fonction pour se deconnecter  ==> Done
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    //Fonction pour afficher profil ==> Done
    public function show_compte_get(){
        if (Auth::check())
        {
            $user = Auth::user();
            return response()->view('auth/show_compte', ['user'=> $user]);
        }
        return "null";
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

        return redirect('compte');
    }

    //Fonction pour reinitialiser mot de passe
    public function reinitialyze_password_get($id){
        return response()->view('auth/resetMotDePass', ['id'=>$id]);
    }
    public function reinitialyze_password_post(Request $request, $id){
        $this->validate($request, [
            'mdp1' => 'required|min:8|same:mdp2',
            'mdp2' => 'required|min:8',
        ]);
        $user = User::find($id);
        $user->mdp = $request->input('mdp2');
        $user->save;
        return redirect('login');
    }


    //Fonction pour reset mdp par email
    public function resetMdpParMail_get(){
        return response()->view('auth/resetMotDePassParMail');
    }
    public function resetMdpParMail_post(Request $request){
        $this->validate($request, [
            'mail' => 'required|exists:user,mail',
        ]);
        $user = User::where('mail', '=', $request->input('mail'))->get()->first();
        $this->sendPWDMail($user);
        return view("confirmpwd");
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
        return redirect('login');
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
            //$users = User::all());
            $users = DB::table('user')->paginate(8);
            $users->setPath('user');
            return response()->view('auth/show_all_user', ['users' => $users]);
        }
        return "Vous êtes pas administrateur";
    }
    public function show_all_user_post(Request $request){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $key = new Collection();
            if($request->input('profil'))
                $key->add(['profil_id', Profil::find($request->input('profil'))->id]);
            if($request->input('parcours'))
                $key->add(['parcours_id', Parcours::find($request->input('parcours'))->id]);
            if($request->input('groupe'))
                $key->add(['groupe_id', Groupe::find($request->input('groupe'))->id]);

            switch (count($key)){
                case 1:
                    $users = DB::table('user')
                        ->where($key[0][0], '=', $key[0][1])->paginate(8);
                    break;
                case 2:
                    $users = DB::table('user')
                        ->where($key[0][0], '=', $key[0][1])
                        ->where($key[1][0], '=', $key[1][1])->paginate(8);
                    break;
                case 3:
                    $users = DB::table('user')
                        ->where($key[0][0], '=', $key[0][1])
                        ->where($key[1][0], '=', $key[1][1])
                        ->where($key[2][0], '=', $key[2][1])->paginate(8);
                    break;
                default:
                    $users = DB::table('user')->paginate(8);
            }
            $users->setPath('user');
            //return $users;
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
            return redirect('admin/user');
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
                'mdp2' => 'min:8',
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

            if ($request->input('mdp2')){
                $user->mdp = $request->input('mdp2');
            }

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
            return redirect('admin/user');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour supprimer un user => Done
    public function delete_user($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour supprimer alll user => Done
    public function delete_all(){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $profil_id = Profil::where('intitule', '=', 'étudiant')->get()->first()->intitule;
            User::where('profil_id', '=', $profil_id)->delete();
            return redirect('admin/user');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour activer un user et lui envoyer une notification par mail => Done
    public function active_user($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $user = User::find($id);
            if($user->actif==0)
            {
                $user->actif = 1;
                $user->save();
                $this->sendValidationMail($id);
            }
            else
            {
                $user->actif = 0;
                $user->save();
            }

            //Enovyer une notification par mail au utilisateur


            return redirect('admin/user');
        }
        return "Vous êtes pas administrateur";
    }
}