@extends('template.templateSecr')

@section('contenu')
<h1>Liste des UE</h1>

    @if(isset($Ues))
        @foreach($Ues as $ue)
        <div class="media">

            <div class="media-left">
                <a href="{{url('listes_emargement/ue/'.$ue->id)}}">
                    <img class="media-object" width="64" src="{{url('img/csv.png')}}">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">{{$ue->intitule}}</h4>
                {{$ue->description}}
            </div>
        </div>
        @endforeach
    @endif

@stop