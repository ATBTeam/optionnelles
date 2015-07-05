<?php

namespace App\Http\Controllers;

use App\Parcours;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Groupe;

class GroupeController extends Controller
{
    //Fonction pour afficher groupes ==> Done
    public function show_groupe(){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $groupes = Groupe::all();
            return response()->view('groupe/show_groupe', ['groupes'=> $groupes]);
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour ajouter un nouveau groupe ==> Done
    public function add_groupe_get(){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $parcours = Parcours::all();
            return response()->view('groupe/add_groupe', ['parcours'=>$parcours]);
        }
        return "Vous êtes pas administrateur";
    }
    public function add_groupe_post(Request $request){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $this->validate($request, [
                'intitule' => 'required|unique:groupe',
                'parcours' => 'exists:parcours,id'
            ]);
            $groupe = new Groupe();
            $groupe->intitule = $request->input('intitule');
            $groupe->parcours_id = $request->input('parcours');
            $groupe->save();
            return redirect('admin/groupe/show');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour supprimer un groupe => Done
    public function delete_groupe($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $groupe = Groupe::find($id);
            $groupe->delete();
            return redirect('admin/groupe/show');
        }
        return "Vous êtes pas administrateur";
    }

    //Fonction pour modifier un groupe ==> Done
    public function update_groupe_get($id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $groupe = Groupe::find($id);
            $parcours = Parcours::all();
            return response()->view('groupe/update_groupe', ['groupe'=> $groupe, 'parcours'=>$parcours]);
        }
        return "Vous êtes pas administrateur";
    }
    public function update_groupe_post(Request $request, $id){
        $user = Auth::user();
        if($user->profil->intitule == "administrateur"){
            $erreurs = new Collection();
            $this->validate($request, [
                'intitule' => 'required',
                'parcours' => 'exists:parcours,id'
            ]);

            $groupes = Groupe::all();
            $groupe = Groupe::find($id);

            foreach($groupes as $g){
                if($request->input('intitule') != $groupe->intitule){
                    if($request->input('intitule') == $g->intitule){
                        $erreurs->prepend("Cet intitulé existe déjà !");
                        break;
                    }
                }
            }

            $groupe->intitule = $request->input('intitule');
            $groupe->parcours_id = $request->input('parcours');
            $parcours = Parcours::all();

            if(count($erreurs) > 0){
                return response()->view('groupe/update_groupe', ['groupe'=> $groupe, 'erreurs'=>$erreurs, 'parcours'=>$parcours]);
            }

            $groupe->save();
            return redirect('admin/groupe/show');
        }
        return "Vous êtes pas administrateur";
    }
}
