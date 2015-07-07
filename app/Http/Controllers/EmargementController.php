<?php
/**
 * Created by PhpStorm.
 * User: HoangCao
 * Date: 01/07/2015
 * Time: 14:38
 */

namespace App\Http\Controllers;
use App\Helpers\Helpers;
use App\Ue;
use App\User;

class EmargementController extends Controller{

//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////// GET

    //Fonction pour page création de spécioalité
    public function get_UeUserList_Page(){
        if(Helpers::isProf())
        {
            $user = Helpers::GetCurrentUser();
            $Ues = $user->uesEnseignees;
            return view('emargement/ueProf', ['Ues'=>$Ues]);
        }
        elseif(Helpers::isSecr())
        {
            $Ues = Ue::all();
            return view('emargement/ueSecr', ['Ues'=>$Ues]);
        }
        else {return redirect('/');}


    }

}