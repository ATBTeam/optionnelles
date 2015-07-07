@extends('template.templateEtud')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">AFFICHAGE DE MES CHOIX</div>
            <div class="panel-body">
                <div class="form-group">
                    <ul>
                        @forelse($choix as $c)
                            <a href="{{ url('/ue', $c->ue->id) }}"><h2>{{ $c->ue->intitule}}</h2></a>
                        @empty
                            <li>Pas de choix effectué ! </li>
                        @endforelse
                    </ul>
                </div>
            </div>
@stop