@if(Helpers::isAdmin() )
    <?php $template = 'template.templateAdmin' ?>
@elseif(Helpers::isProf())
    <?php $template = 'template.templateProf' ?>
@elseif(Helpers::isSecr())
    <?php $template = 'template.templateSecr' ?>
@elseif(Helpers::isEtud())
    <?php $template = 'template.templateEtud' ?>
@endif

@extends($template)
@section('style')
    <style>
        body {
            width: 100%;
            margin: auto;
        }

        td {
            font-size: 12px;
        }

        th {
            font-size: 16px;
        }

        .gestion_ue {
            width: 95%;
            margin: auto;
        }
    </style>
@stop

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">

            <div class="panel-heading">AFFICHAGE D'UE</div>
            <div class="panel-body">
                <div class="form-group">
                    {!! $ue->intitule !!}
                </div>
                <div class="form-group">
                    {!! $ue->description !!}
                </div>
                <div class="form-group">
                    Enseignée au semestre {!! $ue->semestre !!}
                </div>
            </div>
            <div class="panel-heading">Enseignant(s)</div>
            <div class="panel-body">
                <div class="form-group">
                    <ul>
                        @forelse($ue->enseignants as $prof )
                            <li>{!! $prof->prenom !!} {!! $prof->nom !!}</li>
                        @empty
                            <li>Pas précisé</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="panel-heading">Etudiant(s) inscrit(s)</div>
            <div class="panel-body">
                <table class="bordered">
                    <thead>
                    <tr>
                        <th>Etudiant</th>
                        <th>Parcours</th>
                        <th>Est optionnelle</th>
                    </tr>
                    </thead>
                    @foreach($users as $user)
                        <tr>
                            <td>{!! $user->prenom !!} {!! $user->nom !!}</td>
                            <td>{!! $user->parcours->intitule !!}</td>
                            <td> je sais pas</td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
@stop