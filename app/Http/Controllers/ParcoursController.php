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
use App\Specialite;

class ParcoursController extends Controller{

//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////// GET

    //Fonction pour page création de parcours
    public function get_Create_Page(){
        $specialites = Specialite::all();
        return view('ParcoursCreation',['specialites'=> $specialites]);
    }

    //Fonction pour page modifier parcours
    public function get_Update_Page($parcours){
        $specialites = Specialite::all();
        return response()->view('ParcoursModification',['parcours'=> $parcours, 'specialites'=>$specialites]);
    }

    //Fonction pour page liste des parcours
    public function get_List_Page(){
        $parcours = Parcours::all();
        return response()->view('ParcoursList',['parcours'=>  $parcours]);
    }
//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////OPERATIONS CRUD (post)

    //Fonction pour créer parcours
    public function post_Create(ParcoursRequest $request){

        $specialite = Specialite::findOrFail($request->input('specialite'));
        $parcours = new Parcours();
        $parcours->intitule = $request->input('intitule');
        $parcours->description = $request->input('description');
        $parcours->annee = $request->input('annee');
        $parcours->nb_opt_s1 = $request->input('nb_opt_s1');
        $parcours->deb_choix_s1 = $request->input('deb_choix_s1');
        $parcours->fin_choix_s1 = $request->input('fin_choix_s1');
        $parcours->nb_opt_s2 = $request->input('nb_opt_s2');
        $parcours->deb_choix_s2 = $request->input('deb_choix_s2');
        $parcours->fin_choix_s2 = $request->input('fin_choix_s2');
        $parcours->specialite_id= $specialite->id;
        $parcours->save();
        $text = "Le parcours: ".$request->input('intitule')." à été ajouté";
        return view("confirmation",['text'=>$text]);
    }

    //Fonction pour modifier parcours
    public function post_Update(ParcoursRequest $request, $id){
        $parcours = Parcours::findOrFail($id);
        $specialite = Specialite::findOrFail($request->input('specialite'));
        $parcours->intitule = $request->input('intitule');
        $parcours->description = $request->input('description');
        $parcours->annee = $request->input('annee');
        $parcours->nb_opt_s1 = $request->input('nb_opt_s1');
        $parcours->deb_choix_s1 = $request->input('deb_choix_s1');
        $parcours->fin_choix_s1 = $request->input('fin_choix_s1');
        $parcours->nb_opt_s2 = $request->input('nb_opt_s2');
        $parcours->deb_choix_s2 = $request->input('deb_choix_s2');
        $parcours->fin_choix_s2 = $request->input('fin_choix_s2');
        $parcours->specialite_id= $specialite->id;
        $parcours->save();
        $text = "Le parcours: ".$request->input('intitule')." à été modifiée";
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