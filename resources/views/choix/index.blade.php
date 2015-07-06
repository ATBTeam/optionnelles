@extends('template')

@section('contenu')
    <h1>Liste des Choix déjà faits</h1>
    <hr/>

    @foreach($choix as $c)
        <ul>
            <li>{!! $c->user->prenom !!} {!! $c->user->nom !!} - {{ $c->ue->intitule }}</li>
        </ul>
    @endforeach
    {!! $choix->render() !!}

@stop