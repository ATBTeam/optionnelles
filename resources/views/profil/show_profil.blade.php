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
        <h2>PAGE DE GESTION DES PROFILS</h2>
        <a href="add">Créer un nouveau profil</a>
        @if(isset($profils))
            <table class="bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Intitulé</th>
                    <!--
                    <th>Modifier</th>
                    <th>Supprimer</th>
                    -->
                </tr>
                </thead>

                @foreach($profils as $profil)
                    <tr>
                        <td>{{ $profil->id }}</td>
                        <td>{{ $profil->intitule }}</td>
                        <!--
                        <td><a href="update/{{ $profil->id }}" >modifier</a></td>
                        <td><a href="delete/{{ $profil->id }}" >supprimer</a></td>
                        -->
                    </tr>
                @endforeach
            </table>
        @endif
        <a href="add">Créer un nouveau profil</a>
    </div>
@stop
