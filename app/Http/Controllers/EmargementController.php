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
use App\Ue;

class EmargementController extends Controller{

//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////// GET

    //Fonction pour page création de spécioalité
    public function get_UeUserList_Page(){
        if(!(Helpers::isProf() || Helpers::isSecr()))return redirect('/');
        //opération de création de csv
        return view('specialite/specialiteCreation');
    }

}