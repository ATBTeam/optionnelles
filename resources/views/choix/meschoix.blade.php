@extends('template')

@section('contenu')
    <h1>Liste de mes choix</h1>

    @foreach($choix as $c)
        <article>
            <a href="{{ url('/ue', $c->ue->id) }}"><h2>{{ $c->ue->intitule}}</h2></a>
            <div class="body">{!! $c->ue->description !!}</div>
        </article>
    @endforeach
@stop