<?php

namespace App\Http\Controllers;

use App\Http\Requests\UeRequest;
use App\Ue;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UesController extends Controller
{

    public function index()
    {
        $ues = Ue::all();

        return view('ues.index', compact('ues'));
    }

    public function show(UE $ue)
    {
        return view('ues.show', compact('ue'));
    }

    public function create()
    {
        return view('ues.create');
    }

    public function store(UeRequest $request)
    {
        Ue::create($request->all());

        return redirect('ue');
    }

    public function edit(Ue $ue)
    {
        return view('ues.edit', compact('ue'));
    }

    public function update(Ue $ue, UeRequest $request)
    {
        $ue->update($request->all());

        return redirect('ue');
    }
}
