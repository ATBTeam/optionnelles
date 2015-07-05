<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Profil;

class ProfilController extends Controller
{
    //Fonction pour afficher profil ==> Done
    public function show_profil(){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $profils = Profil::all();
            return response()->view('profil/show_profil', ['profils'=> $profils]);
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour ajouter un nouveau profil ==> Done
    public function add_profil_get(){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            return response()->view('profil/add_profil');
        }
        return "Vous êtes pas administrateur";
    }
    public function add_profil_post(Request $request){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $this->validate($request, [
                'intitule' => 'required|unique:profil'
            ]);
            $profil = new Profil();
            $profil->intitule = $request->input('intitule');
            $profil->save();
            return redirect('admin/profil/show');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour supprimer un profil => Done
    public function delete_profil($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $profil = Profil::find($id);
            $profil->delete();
            return redirect('admin/profil/show');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour modifier un nouveau profil ==> Done
    public function update_profil_get($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $profil = Profil::find($id);
            return response()->view('profil/update_profil', ['profil'=> $profil]);
        }
        return "Vous êtes pas administrateur";
    }
    public function update_profil_post(Request $request, $id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $erreurs = new Collection();
            $this->validate($request, [
                'intitule' => 'required'
            ]);

            $profils = Profil::all();
            $profil = Profil::find($id);

            foreach($profils as $p){
                if($request->input('intitule') != $profil->intitule){
                    if($request->input('intitule') == $p->intitule){
                        $erreurs->prepend("Cet intitulé existe déjà !");
                        break;
                    }
                }
            }

            $profil->intitule = $request->input('intitule');

            if(count($erreurs) > 0){
                return response()->view('profil/update_profil', ['profil'=> $profil, 'erreurs'=>$erreurs]);
            }

            $profil->save();
            return redirect('admin/profil/show');
        }
        return "Vous êtes pas administrateur";
    }
}
