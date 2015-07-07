<?php
/**
 * Created by PhpStorm.
 * User: HoangCao
 * Date: 01/07/2015
 * Time: 14:38
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\SpecialiteRequest;
use App\Helpers\Helpers;
use App\Specialite;
use App\Helpers\Helpers;

class SpecialiteController extends Controller{

//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////// GET

    //Fonction pour page création de spécioalité
    public function get_Create_Page(){
        if(!Helpers::isAdmin())return redirect('/');
        return view('specialite/specialiteCreation');
    }

    //Fonction pour page modifier spécialité
    public function get_Update_Page($specialite){
        if(!Helpers::isAdmin())return redirect('/');
        return response()->view('specialite/specialiteModification',['specialite'=> $specialite]);
    }

    //Fonction pour page liste spécialité
    public function get_List_Page(){
        if(!Helpers::isAdmin())return redirect('/');
        $specialites = Specialite::all();
        return response()->view('specialite/specialiteList',['specialites'=>  $specialites]);
    }
//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////OPERATIONS CRUD (post)

    //Fonction pour créer spécialité
    public function post_Create(SpecialiteRequest $request){
        if(!Helpers::isAdmin())return redirect('/');
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
        if(!Helpers::isAdmin())return redirect('/');
        $specialite = Specialite::findOrFail($id);
        $old = $specialite->intitule;
        $specialite->intitule = $request->input('nom');
        $specialite->description = $request->input('texte');
        $specialite->save();
        $text = "La spécialité : ".$old."=>".$request->input('nom')." à été modifiée";
        return view("confirmation",['text'=>$text]);
    }

    //Fonction pour ouvrir page modifier spécialité depuis liste
    public function post_Update_Page(Request $request){
        if(!Helpers::isAdmin())return redirect('/');
        $specialite = Specialite::findOrFail($request->input('specialite'));
        return $this->get_Update_Page($specialite);
    }
    //Fonction pour page confirmation supression  specialite
    public function post_Delete_Page(Request $request){
        if(!Helpers::isAdmin())return redirect('/');
        $specialite = Specialite::findOrFail($request->input('id_specialite'));
        return response()->view('specialite/SpecialiteSuppression',['specialite'=> $specialite]);
    }

    //Fonction pour supprimer spécialité
    public function post_DeleteConfirm($id){
        if(!Helpers::isAdmin())return redirect('/');
        $text = Specialite::findOrFail($id)->intitule. " à été supprimé";
        Specialite::destroy($id);
        return view("confirmation",['text'=>$text]);
    }
    public function post_DeleteCancel(){
        if(!Helpers::isAdmin())return redirect('/');
        $text= "Supression annulée";
        return view("confirmation",['text'=>$text]);
    }

}