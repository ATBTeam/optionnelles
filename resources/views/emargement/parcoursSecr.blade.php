@extends('template.templateSecr')

@section('contenu')
<h1>Liste des Parcours</h1>

    @if(isset($Parcours))
        @foreach($Parcours as $ue)
        <div class="media">

            <div class="media-left">
                <a href="#">
                    <img class="media-object" width="64" src="{{url('img/csv.png')}}">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$ue->intitule ." ". $ue->specialite->intitule}}</h4>
                {{$ue->description}}
            </div>
        </div>
        @endforeach
    @endif
@stop