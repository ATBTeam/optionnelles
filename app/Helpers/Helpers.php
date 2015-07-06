<?php
/**
 * Created by PhpStorm.
 * User: ALIENWARE!
 * Date: 05/07/2015
 * Time: 19:53
 */

namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\User;

class Helpers {

    public static function ConvertDateString($dateString)
    {   //2013-10-09T15:38:00
        $myDateTime=strftime('%Y-%m-%dT%H:%M:%S', strtotime($dateString));
        return $myDateTime;
    }

    public static function GetCurrentUser()
    {
        if(Auth::check())
        {
           $user = Auth::user();
           return $user;
        }
        //else return redirect('/');
        else return null;
    }

    public static function isAdmin()
    {
        $user = Auth::user();
        if(isset($user))
        {
            if($user->profil->intitule == "administrateur"){ return true ;}
            else {return false;}
        }
        else{
            return false;
        }

    }
}