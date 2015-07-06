@extends('template')

@section('contenu')
    <h1>Liste des Choix disponibles pour les {!! $parcours->intitule !!}</h1>

    @foreach($ues as $ue)
        <article>
            <a href="{{ url('/ue', $ue->id) }}"><h2>{{ $ue->intitule}}</h2></a>

            <div class="body">{{ $ue->intitule }}</div>
            <div class="body">{!! $ue->description !!}</div>
        </article>
    @endforeach
@stop