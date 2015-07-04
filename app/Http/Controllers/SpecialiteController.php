<?php
/**
 * Created by PhpStorm.
 * User: HoangCao
 * Date: 01/07/2015
 * Time: 14:38
 */

namespace App\Http\Controllers;

use App\Http\Requests\SpecialiteRequest;
use App\Specialite;

class SpecialiteController extends Controller{

//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////// GET

    //Fonction pour page création de spécioalité
    public function get_Create_Page(){
        return view('specialiteCreation');
    }

    //Fonction pour page modifier spécialité
    public function get_Update_Page(Specialite $specialite){
        return response()->view('specialiteModification',['specialite'=> $specialite]);
    }
//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////OPERATIONS CRUD (post)

    //Fonction pour créer spécialité
    public function post_Create(SpecialiteRequest $request){
        //1)test pour savoir si une spé a déja le même nom
        $specialite = new Specialite();
        $specialite->intitule = $request->input('nom');
        $specialite->description = $request->input('texte');
        $specialite->save();
        $text = "La spécialité : ".$request->input('nom')." à été ajoutée";
        return view("confirmation",['text'=>$text]);
    }

    //Fonction pour modifier spécialité
    public function post_Update(SpecialiteRequest $request, $id){
        $specialite = Specialite::findOrFail($id);
        $specialite->intitule = $request->input('nom');
        $specialite->description = $request->input('texte');
        $specialite->save();
        return "page de validation spécialité modifiée";
    }
    //Fonction pour supprimer spécialité
    public function Delete($id){
        //opération CRUD
        return "page de validation spécialité supprimée";
    }

}