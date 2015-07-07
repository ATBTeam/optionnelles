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
use App\Choix;
use App\User;
use App\Parcours;
use App\Parcours_ue;

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

    public function get_ParcoursUserList_Page(){
        if(Helpers::isSecr())
        {
           $Parcours = Parcours::all();
            return view('emargement/parcoursSecr', ['Parcours'=>$Parcours]);
        }
        else {return redirect('/');}


    }

    public function get_ParcoursUserList_csv($id){
        if(!Helpers::isSecr()) return redirect('/');
        $parcours = Parcours::findOrFail($id);
        $users = $parcours->users;

        $output = fopen('php://memory', 'w');
        $filename=$parcours->intitule."_".$parcours->specialite->intitule.'.csv';
        // output the column headings
        fputcsv($output, array($parcours->intitule, $parcours->specialite->intitule), ';');
        fputcsv($output, array('Nom', 'Prénom', '@mail', 'actif'),';');
        // loop over the rows, outputting them
        foreach($users as $user)
        {
            fputcsv($output,  array($user->nom, $user->prenom, $user->mail, $user->actif),';');
        }
         // reset the file pointer to the start of the file
        fseek($output, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($output);
        return null;
    }

    public function get_UeUserList_csv($id){
        if(!(Helpers::isProf()||Helpers::isSecr())) return redirect('/');
        $ue = Ue::FindOrFail($id);
        $parcours_ue = $ue->parcours_ues;
        $output = fopen('php://memory', 'w');
        $filename=$ue->intitule.'.csv';
        // output the column headings
        fputcsv($output, array($ue->intitule), ';');
        fputcsv($output, array('Nom', 'Prénom', '@mail', 'actif'),';');
        // loop over the rows, outputting them
        foreach($parcours_ue->choixes as $choix)
        {
            $user = $choix->user;
            fputcsv($output, array($user->nom, $user->prenom, $user->mail, $user->actif), ';');
        }
        // reset the file pointer to the start of the file
        fseek($output, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($output);
        return null;
    }

}