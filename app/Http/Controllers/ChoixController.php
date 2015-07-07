<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
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
        if(Auth::check()) {
            //$choix = Choix::all();
            $choix = Choix::paginate(40);

            //return view('choix.index', compact('choix'));
            return response()->view('choix/index', ['choix' => $choix]);
        }
        return redirect('/');
    }

    public function show($id)
    {

    }

    public function create()
    {
        if(Auth::check()) {
            // TODO : remplacer  User::find(1)  par Auth::user()
            $parcours = Auth::user()->parcours()->first();

            //$parcours = User::find($this->userId)->parcours()->first();

            $ues_s1 = $parcours->ues()->where('semestre', 1)->get();

            $ues_s2 = $parcours->ues()->where('semestre', 2)->get();

            $ues = array($ues_s1, $ues_s2);
            return response()->view('choix/create', ['parcours' => $parcours, 'ues' => $ues]);
        }
        return redirect('/');
    }

    public function store(Request $request)
    {
        // Todo : Auth::user()->id;
        //$user = User::find($this->userId);
        $user = Auth::user();
        $parcours = $user->parcours()->first();
        $plusDePlace = false;

        for ($semestre = 1; $semestre <= 2; ++$semestre) {
            $nbopt = ($semestre == 1) ? $parcours->nb_opt_s1 : $parcours->nb_opt_s2;
            $deb = ($semestre == 1) ? $parcours->deb_choix_s1 : $parcours->deb_choix_s2;
            $fin = ($semestre ==1) ? $parcours->fin_choix_s1 : $parcours->fin_choix_s2;
            $date_debut = Carbon::createFromFormat('Y-m-d H:i:s', $deb);
            $date_fin = Carbon::createFromFormat('Y-m-d H:i:s', $fin);

            if (! Carbon::now()->between($date_debut, $date_fin) && Carbon::now() > $date_fin){
                \Session::flash('trop_tard_s' . $semestre, 'Les choix sont clos ! Vos modifications ne sont pas enregistrées.');
                return redirect('choix/choisir');
            }
            if (count($request->input('choix_s' . $semestre)) > $nbopt) {
                \Session::flash('trop_choix_s' . $semestre, 'Vous ne pouvez faire que ' . $nbopt . ' choix');
                return redirect('choix/choisir')->withInput();
            }

            $choixPrecedents = Choix::join('ue', 'ue.id', '=', 'choix.ue_id')
                ->where('user_id', $user->id)
                ->where('semestre', $semestre)
                ->select('ue_id')
                ->get();

            // Parcours
            foreach ((array) $request->input('choix_s' . $semestre) as $ue_id) {
                // Si ce choix n'est pas encore effectué, on le sauvegarde à moins qu'il n'y ait plus de place
                if (! $choixPrecedents->contains('ue_id', $ue_id)) {
                    if ($this->estPlein($user->parcours()->first()->id, $ue_id)) {
                        $plusDePlace = true;
                        \Session::flash('sature' . $ue_id, 'Plus de place disponible !');
                    } else {
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
        }

        if ($plusDePlace) {
            return redirect('choix/choisir');
        } else {
            return redirect('choix');
        }
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
        $choix = Auth::user()->choixes()->get();
        //$choix = User::find($this->userId)->choixes()->get();

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
        if ($nbInscrits == Parcours_ue::where('ue_id', $ue_id)->first()->nbmax) {
            $choix = new Choix();
        }
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
