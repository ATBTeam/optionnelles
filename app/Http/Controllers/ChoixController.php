<?php

namespace App\Http\Controllers;

use App\Choix;
use App\Parcours;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChoixController extends Controller
{

    public function index()
    {
        $choix = Choix::all();

        return view ('choix.index', compact('choix'));
    }

    public function create()
    {
        // TODO : remplacer  User::find(1)  par Auth::user()
        //$parcours = Auth::user()->parcours()->first();
        $parcours = User::find(3)->parcours()->first();

        $ues = $parcours->ues()->get();
        return view('choix.create', compact('parcours', 'ues'));
    }

    public function show($id){

    }

    public function mesChoix(){
        // TODO remplacer User::find(1) par Auth::user()
        //$choix = Auth::user()->choixes()->get();
        $choix = User::find(1)->choixes()->get();

        return view ('choix.meschoix', compact('choix'));
    }
}
