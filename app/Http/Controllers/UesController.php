<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\UeRequest;
use App\Parcours;
use App\Parcours_ue;
use App\Ue;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UesController extends Controller
{

    public function index()
    {
        if (Helpers::isAdmin()) {
            $ues = Ue::all();

            return response()->view('ues.show_all_ue', compact('ues'));
        }

        return redirect('/');
    }

    public function show(UE $ue)
    {
        return view('ues.show', compact('ue'));
    }

    public function create()
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }
        $ue = new Ue();
        $parcours_ue = new Parcours_ue();

        $parcours = Parcours::all();

        return response()->view('ues.create', compact('parcours', 'parcours_ue'));

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

        return response()->view('ues.edit', compact('ue', 'parcours'));

    }

    public function update(Ue $ue, UeRequest $request)
    {
        if (! Helpers::isAdmin()) {
            return redirect('/');
        }

        $ue->update($request->all());

        return redirect('admin/ue');
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

    public function show_Ue_enseignees($prof_id){ // $prof_id  sera $user_id

    }
}
