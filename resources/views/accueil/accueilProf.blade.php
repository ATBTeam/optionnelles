@extends('template.templateProf')

@section('contenu')
    <h1>Bienvenue sur la gestion des optionnelles !</h1>
    @if(!Helpers::GetCurrentUser()==null)
        @foreach(Helpers::GetCurrentUser()->uesEnseignees()->ue as $ue)
        <div class="media">

            <div class="media-left">
                <a href="#">
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