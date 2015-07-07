@extends('template.templateAdmin')

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

    <div class="gestion_ue">
        <h2>PAGE DE GESTION DES UE</h2>
        <a href="{{ url('admin/ue/add') }}">Créer une nouvelle UE</a>
        @if(isset($ues))
            <table class="bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Intitulé</th>
                    <th>Semestre</th>
                    <th>Parcours</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>

                @foreach($ues as $ue)
                    <tr>
                        <td>{{ $ue->id }}</td>
                        <td>{{ $ue->intitule }}</td>
                        <td>{{ $ue->semestre }}</td>
                        <td>
                            @forelse($ue->parcours()->get() as $parcours )
                                <ul>
                                    <li>{!! $parcours->intitule !!} : {!! App\Choix::parUe($ue->id)->parParcours($parcours->id)->count() !!}
                                    / {!! App\Parcours_ue::parcoursUe($parcours->id, $ue->id)->first()->nbmax !!} inscrit(s)</li>
                                </ul>
                            @empty
                                pas précisé
                            @endforelse
                        </td>
                        <td><a href="{{url('admin/ue/update/' . $ue->id) }}">modifier</a></td>
                        <td><a href="{{ url('admin/ue/delete/' . $ue->id) }}">supprimer</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
        <a href="{{ url('admin/ue/add') }}">Créer une nouvelle UE</a>
    </div>
@stop