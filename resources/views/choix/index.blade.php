@extends('template.templateAdmin')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            @if($type == 'Parcours')
            <div class="panel-heading">AFFICHAGE DES CHOIX DU PARCOURS {!! App\Parcours::find($id)->intitule !!}</div>
            @elseif($type == 'Ue')
                <div class="panel-heading">AFFICHAGE DES CHOIX DE L'UE {!! App\Ue::find($id)->intitule !!}</div>
                @elseif($type == 'User')
                <div class="panel-heading">AFFICHAGE DES CHOIX DE {!! App\User::find($id)->prenom !!} {!! App\User::find($id)->nom !!}</div>
                @else
                <div class="panel-heading">AFFICHAGE DES CHOIX DU PARCOURS {!! App\Parcours::find($id)->intitule !!}</div>
                @endif
            <div class="panel-body">
                <div class="form-group">
                    @foreach($choix as $c)
                        <ul>
                            <li>{!! $c->user->prenom !!} {!! $c->user->nom !!} - {{ $c->ue->intitule }}</li>
                        </ul>
                    @endforeach
                    {!! $choix->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop