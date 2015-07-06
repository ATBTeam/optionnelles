<?php

namespace App\Http\Controllers;

use App\Choix;
use App\Http\Requests\ChoixRequest;
use App\Parcours;
use App\Parcours_ue;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class ChoixController extends Controller
{

    public function index()
    {
        //$choix = Choix::all();
        $choix = Choix::paginate(40);

        return view('choix.index', compact('choix'));
    }

    public function show($id)
    {

    }

    public function create()
    {
        // TODO : remplacer  User::find(1)  par Auth::user()
        //$parcours = Auth::user()->parcours()->first();
        $parcours = User::find(1)->parcours()->first();

        $ues = $parcours->ues()->get();

        return view('choix.create', compact('parcours', 'ues'));
    }

    public function store(ChoixRequest $request)
    {
        // Récupération du nombre d'optionnelles pour le parcours de l'utilisateur
        // Todo : Auth::user()->id;
        $user = User::find(1);
        $parcours = $user->parcours()->first();

        // TODO : gérer les semestres
        $nbopt = $parcours->nb_opt_s1;

        // S'il y en a plus que prévu, retour au questionnaire sans validation
        if (count($request->input('choix')) > $nbopt) {

            return redirect('choix/choisir')->withErrors(array(
                'choix',
                'Vous ne pouvez faire que ' . $nbopt . ' choix'
            ))->withInput();
        }
        // Récupération des choix précédents éventuels
        $choixPrecedents = Choix::select('ue_id')->where('user_id', $user->id)->get();

        // Parcours
        foreach ((array)$request->input('choix') as $ue_id) {
            // Si ce choix n'est pas encore effectué, on le sauvegarde
            if (! $choixPrecedents->contains('ue_id', $ue_id)) {
                $choix = new Choix();
                $choix->ue_id = $ue_id;
                $choix->user_id = $user->id;
                $choix->parcours_id = $user->parcours()->first()->id;

                $choix->date_choix = date('Y-m-d H:i:s');
                $choix->save();
            } else // sinon on ne fait pas d'opération en base mais on supprime du tableau
            {
                $choixPrecedents = $choixPrecedents->filter(function ($item) use ($ue_id) {
                    return $item->ue_id != $ue_id;
                });
            }

        }
        // Parcours pour la suppression des choix précédents décochés
        if ($choixPrecedents->count() > 0) {
            foreach($choixPrecedents as $vieuxChoix)
            {
                $choix = Choix::where('ue_id', $vieuxChoix->ue_id)->where('user_id', $user->id);
                $choix->delete();
            }
        }

        return redirect('choix');
    }

    public function mesChoix()
    {
        // TODO remplacer User::find(1) par Auth::user()
        //$choix = Auth::user()->choixes()->get();
        $choix = User::find(1)->choixes()->get();

        return view('choix.meschoix', compact('choix'));
    }
}
