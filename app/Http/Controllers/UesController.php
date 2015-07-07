<?php

namespace App\Http\Controllers;

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
        $user = Auth::user();
        if ($user->profil->intitule == "administrateur") {
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
        $user = Auth::user();
        if ($user->profil->intitule == "administrateur") {
            $parcours = Parcours::all();

            return response()->view('ues.create', compact('parcours'));
        }

        return redirect('/');
        //return view('ues.create');
    }

    public function store(UeRequest $request)
    {
        $ue = Ue::create($request->all());

        $liste_parcours = Parcours::all();
        $parcours_ue = [];
        foreach ($liste_parcours as $parcours) {
            $statut = $request->get('statut' . $parcours->id);
            $nbmin = $request->get('nbmin' . $parcours->id);
            $nbmax = $request->get('nbmax' . $parcours->id);
            if ($statut != 2 && !empty($nbmin) && !empty($nbmax)) {
                $parc_ue = new Parcours_ue();
                $parc_ue->parcours_id = $parcours->id;
                $parc_ue->est_optionnel = $statut;
                $parc_ue->nbmin = $nbmin;
                $parc_ue->nbmax  = $nbmax;

                array_push($parcours_ue, $parc_ue);
            }

            $ue->parcours_ues()->saveMany($parcours_ue);
        }

        return redirect('admin/ue');
    }

    public function edit(Ue $ue)
    {
        $user = Auth::user();
        if ($user->profil->intitule == "administrateur") {
            $parcours = Parcours::all();

            return response()->view('ues.edit', compact('ue', 'parcours'));
        }

        return redirect('/');
        //return view('ues.edit', compact('ue'));
    }

    public function update(Ue $ue, UeRequest $request)
    {
        $ue->update($request->all());

        return redirect('admin/ue');
    }

    public function post_Delete_Page(Ue $ue)
    {
        $user = Auth::user();
        if ($user->profil->intitule == "administrateur") {
            return response()->view('ues.suppression', compact('ue'));
        }

        return redirect('/');
    }

    public function post_DeleteConfirm(Ue $ue)
    {
        $user = Auth::user();
        if ($user->profil->intitule == "administrateur") {
            $text = $ue->intitule . " à été supprimée";
            $ue->delete();

            return view('confirmation', compact('text'));
        }

        return redirect('/');
    }

    public function post_DeleteCancel()
    {
        $user = Auth::user();
        if ($user->profil->intitule == "administrateur") {
            $text = "Supression annulée";

            return view("confirmation", ['text' => $text]);
        }

        return redirect('/');
    }
}
