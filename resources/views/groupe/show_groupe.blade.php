@extends('template.templateAdmin')

@section('style')
    <style>
        body{width:100%; margin:auto;}
        td{font-size:12px;}
        th{font-size:16px;}
        .gestion_user{width:95%; margin:auto;}
    </style>

@section('contenu')
    <br>

    <div class="gestion_user">
        <h2>PAGE DE GESTION DES GROUPES</h2>
        <a href="{!! url('admin/groupe/add') !!}">Créer un nouveau grouper</a>
        @if(isset($groupes))
            <table class="bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Intitulé</th>
                    <th>Description</th>
                    <th>Parcours</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>

                @foreach($groupes as $groupe)
                    <tr>
                        <td>{{ $groupe->id }}</td>
                        <td>{{ $groupe->intitule }}</td>
                        <td>{{ $groupe->description }}</td>
                        <td>{{ $groupe->parcours->intitule }}</td>
                        <td><a href="admin/groupe/update/{{$groupe->id}}" >modifier</a></td>
                        <td><a href="admin/groupe/delete/{{$groupe->id}}" >supprimer</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
        <a href="{!! url('admin/groupe/add')!!}">Créer un nouveau groupe</a>
    </div>
@stop
