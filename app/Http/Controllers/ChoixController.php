<?php

namespace App\Http\Controllers;

use App\Choix;
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
    //TODO à virer !! Auth::user()
    protected $userId = 1;

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
        $parcours = User::find($this->userId)->parcours()->first();

        $ues = $parcours->ues()->get();

        return view('choix.create', compact('parcours', 'ues'));
    }

    public function store(Request $request)
    {
        // Récupération du nombre d'optionnelles pour le parcours de l'utilisateur
        // Todo : Auth::user()->id;
        $user = User::find($this->userId);
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
        $plusDePlace = false;
        // Parcours
        foreach ((array) $request->input('choix') as $ue_id) {

            // Si ce choix n'est pas encore effectué, on le sauvegarde à moins qu'il n'y ait plus de place
            if (! $choixPrecedents->contains('ue_id', $ue_id)) {
                if($this->estPlein($user->parcours()->first()->id, $ue_id))
                {
                    $plusDePlace = true;
                    \Session::flash('sature' . $ue_id, 'Plus de place disponible !');
                }
                else {
                    $choix = new Choix();
                    $choix->ue_id = $ue_id;
                    $choix->user_id = $user->id;
                    $choix->parcours_id = $user->parcours()->first()->id;

                    $choix->date_choix = date('Y-m-d H:i:s');
                    $choix->save();
                }
            } else // sinon on ne fait pas d'opération en base mais on supprime du tableau
            {
                $choixPrecedents = $choixPrecedents->filter(function ($item) use ($ue_id) {
                    return $item->ue_id != $ue_id;
                });
            }

        }
        // Parcours pour la suppression des choix précédents décochés
        if ($choixPrecedents->count() > 0) {
            foreach ($choixPrecedents as $vieuxChoix) {
                $choix = Choix::where('ue_id', $vieuxChoix->ue_id)->where('user_id', $user->id);
                $choix->delete();
            }
        }
        if($plusDePlace)
            return redirect('choix/choisir');
        else
            return redirect('choix');
    }

    private function estPlein($parcours_id, $ue_id)
    {
        return
            //Parcours_ue::where('ue_id', $ue_id)->where('parcours_id', $parcours_id)->first()->nbmax
            Parcours_ue::parcoursUe($parcours_id, $ue_id)->first()->nbmax
            <=
            Choix::parUe($ue_id)->parParcours($parcours_id)->count();
    }

    public function mesChoix()
    {
        // TODO remplacer User::find(1) par Auth::user()
        //$choix = Auth::user()->choixes()->get();
        $choix = User::find($this->userId)->choixes()->get();

        return view('choix.meschoix', compact('choix'));
    }

    public function getChoixParParcours($parcours_id)
    {
        $choix = Choix::parParcours($parcours_id)->paginate(40);

        return view('choix.index', compact('choix', 'nbmax'));
    }

    public function getChoixParUe($ue_id)
    {
        $choix = Choix::parUe($ue_id)->paginate(40);

        return view('choix.index', compact('choix'));
    }

    public function getChoixParUser($user_id)
    {
        $choix = Choix::parUser($user_id)->paginate(40);

        return view('choix.index', compact('choix'));
    }

    public function adminAjoutUser($ue_id, $user_id)
    {
        $parcours_id = User::find($user_id)->first()->parcours()->first()->id;
        $nbInscrits = $this->getNbInscritsParParcours($ue_id, $parcours_id);
        if ($nbInscrits == Parcours_ue::where('ue_id', $ue->id)->first()->nbmax)
        $choix = new Choix();
        $choix->ue_id = $ue_id;
        $choix->user_id = $user_id;
        $choix->parcours_id = User::find($user_id)->first()->parcours()->first()->id;

        $choix->date_choix = date('Y-m-d H:i:s');
        $choix->save();
    }

    public function adminSupprUser($ue_id, $user_id)
    {

    }

    public function getNbInscritsParParcours($ue_id, $parcours_id)
    {
        return Choix::where('ue_id', $ue_id)->where('parcours_id', $parcours_id)->count();
    }

    public function getNbMaxParParcours($ue_id, $parcours_id)
    {
        return Parcours_ue::where('ue_id', $ue_id)->where('parcours_id', $parcours_id)->first()->nbmax;
    }
}
