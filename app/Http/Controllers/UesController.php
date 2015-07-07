<?php

namespace App\Http\Controllers;

use App\Choix;
use App\Helpers\Helpers;
use App\Http\Requests\UeRequest;
use App\Parcours;
use App\Parcours_ue;
use App\Ue;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UesController extends Controller
{

    public function index()
    {
        if (Helpers::isAdmin() || Helpers::isSecr()) {
            $ues = Ue::all();

            return response()->view('ues.show_all_ue', compact('ues'));
        }
        else if(Helpers::isProf()){
            $ues = Auth::user()->uesEnseignees()->get();

            return response()->view('ues.show_all_ue', compact('ues'));
        }

        return redirect('/');
    }

    public function show(UE $ue)
    {

        $choix = Choix::parUe($ue->id)->get();
        $users = [];
        foreach($choix as $c)
        {
            array_push($users, User::where('id', $c->user_id)->first());
        }
        return view('ues.show', compact('ue', 'users'));
    }

    public function create()
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }
        $ue = new Ue();

        $parcours_ues = new Collection();
        $parcours = Parcours::all();


        return response()->view('ues.create', compact('parcours', 'parcours_ues'));

        //return view('ues.create');
    }

    public function store(UeRequest $request)
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }
        $ue = Ue::create($request->all());

        $liste_parcours = Parcours::all();
        $parcours_ue = [];
        foreach ($liste_parcours as $parcours) {
            $statut = $request->get('statut' . $parcours->id);
            $nbmin = $request->get('nbmin' . $parcours->id);
            $nbmax = $request->get('nbmax' . $parcours->id);
            if ($statut != 2 && ! empty($nbmin) && ! empty($nbmax)) {
                $parc_ue = new Parcours_ue();
                $parc_ue->parcours_id = $parcours->id;
                $parc_ue->est_optionnel = $statut;
                $parc_ue->nbmin = $nbmin;
                $parc_ue->nbmax = $nbmax;

                array_push($parcours_ue, $parc_ue);
            }

            $ue->parcours_ues()->saveMany($parcours_ue);
        }

        return redirect('admin/ue');
    }

    public function edit(Ue $ue)
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }
        $parcours = Parcours::all();

        $parcours_ues = $ue->parcours_ues()->get();

        return response()->view('ues.edit', compact('ue', 'parcours', 'parcours_ues'));

    }

    public function update(Ue $ue, UeRequest $request)
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }

        $choix_precedents = $ue->parcours_ues()->get();
        $ue->update($request->all());
        $liste_parcours = Parcours::all();
        $parcours_ue = [];
        foreach ($liste_parcours as $parcours) {
            $statut = $request->get('statut' . $parcours->id);
            $nbmin = $request->get('nbmin' . $parcours->id);
            $nbmax = $request->get('nbmax' . $parcours->id);

            if ($statut == 2 && $choix_precedents->contains('parcours_id', $parcours->id)) {
                // C'est une suppression de parcours_ue
                $ue->parcours_ues()->where('parcours_id', $parcours->id)->delete();
                Choix::parUe($ue->id)->delete();

                $parc_ue = $choix_precedents->where('parcours_id', $parcours->id)->first();
            }
            if ($statut != 2 && ! empty($nbmin) && ! empty($nbmax)) {
                if ( $choix_precedents->contains('parcours_id', $parcours->id)) {
                    // C'est une mise à jour de parcours_ue
                    $parc_ue = $choix_precedents->where('parcours_id', $parcours->id)->first();
                    if ($parc_ue->statut != $statut || $parc_ue->nbmin != $nbmin || $parc_ue->nbmax != $nbmax)
                    {
                        Parcours_ue::where('parcours_id', $parcours->id)
                            ->where('ue_id', $ue->id)
                            ->update(['est_optionnel' => $statut, 'nbmin' => $nbmin, 'nbmax' => $nbmax]);
                    }
                } else {
                    // C'est une création de parcours_ue
                    $parc_ue = new Parcours_ue();
                    $parc_ue->parcours_id = $parcours->id;
                    $parc_ue->est_optionnel = $statut;
                    $parc_ue->nbmin = $nbmin;
                    $parc_ue->nbmax = $nbmax;
                    array_push($parcours_ue, $parc_ue);
                }
            }
            $ue->parcours_ues()->saveMany($parcours_ue);
        }

        return redirect('admin/ue');

        /*
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }

        $ue->update($request->all());


        return redirect('admin/ue');
        */
    }

    public function post_Delete_Page(Ue $ue)
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }

        return response()->view('ues.suppression', compact('ue'));
    }

    public function post_DeleteConfirm(Ue $ue)
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }
        $text = $ue->intitule . " à été supprimée";
        Choix::parUe($ue->id)->delete();
        $ue->delete();

        return view('confirmation', compact('text'));
    }

    public function post_DeleteCancel()
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }
        $text = "Supression annulée";

        return view("confirmation", ['text' => $text]);

    }

    public function show_Ue_enseignees($prof_id)
    { // $prof_id  sera $user_id

    }
}
