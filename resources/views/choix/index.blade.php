@extends('template')

@section('contenu')
    <h1>Liste des Choix déjà faits</h1>
    <hr/>

    @foreach($choix as $c)
        <article>
            <div class="body">{{ $c->ue->intitule }}</div>
            <div class="body">{!! $c->user->prenom !!} {!! $c->user->nom !!}</div>
        </article>
    @endforeach
@stop