<?php
/**
 * Created by PhpStorm.
 * User: HoangCao
 * Date: 01/07/2015
 * Time: 14:38
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ParcoursRequest;
use App\Parcours;

class ParcoursController extends Controller{

//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////// GET

    //Fonction pour page création de spécioalité
    public function get_Create_Page(){
        return view('parcoursCreation');
    }

    //Fonction pour page modifier parcours
    public function get_Update_Page($parcours){
        return response()->view('parcoursModification',['parcours'=> $parcours]);
    }

    //Fonction pour page liste des parcours
    public function get_List_Page(){
        $parcours = Parcours::all();
        return response()->view('parcoursList',['parcours'=>  $parcours]);
    }
//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////OPERATIONS CRUD (post)

    //Fonction pour créer parcours
    public function post_Create(ParcoursRequest $request){
        //1)test pour savoir si une spé a déja le même nom
        $parcours = new Parcours();
        $parcours->intitule = $request->input('nom');
        $parcours->description = $request->input('texte');
        $parcours->save();
        $text = "Le parcours: ".$request->input('nom')." à été ajoutée";
        return view("confirmation",['text'=>$text]);
    }

    //Fonction pour modifier parcours
    public function post_Update(ParcoursRequest $request, $id){
        $parcours = Parcours::findOrFail($id);
        $old = $parcours->intitule;
        $parcours->intitule = $request->input('nom');
        $parcours->description = $request->input('texte');
        $parcours->save();
        $text = "Le parcours: ".$old."=>".$request->input('nom')." à été modifiée";
        return view("confirmation",['text'=>$text]);
    }

    //Fonction pour ouvrir page modifier parcours depuis liste
    public function post_Update_Page(Request $request){
        $parcours = Parcours::findOrFail($request->input('parcours'));
        return $this->get_Update_Page($parcours);
    }
    //Fonction pour supprimer spécialité
    public function Delete($id){
        Parcours::destroy($id);
        return "page de validation parcours supprimée";
    }

}