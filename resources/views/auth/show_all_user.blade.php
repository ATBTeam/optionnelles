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
        <h2>PAGE DE GESTION DES UTILISATEURS</h2>
        <a href="add">Créer un nouveau utilisateur</a>
        @if(isset($users))
            <table class="bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Login</th>
                    <th>Mot de passe</th>
                    <th>Profil</th>
                    <th>Groupe</th>
                    <th>Parcours</th>
                    <th>Activé</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
                </thead>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->mail }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->mdp }}</td>
                        <td>{{ $user->profil->intitule }}</td>
                        @if(isset($user->groupe_id))
                            <td>{{ $user->groupe->intitule }}</td>
                        @else
                            <td>pas précisé</td>
                        @endif
                        @if(isset($user->parcours_id))
                            <td>{{ $user->parcours->intitule }}</td>
                        @else
                            <td>pas précisé</td>
                        @endif

                        @if($user->actif==1)
                            <td><a href="active/{{ $user->id }}" >activé</a></td>
                        @else
                            <td><a href="active/{{ $user->id }}" >pas activé</a></td>
                        @endif
                        <td><a href="update/{{ $user->id }}" >modifier</a></td>
                        <td><a href="delete/{{ $user->id }}" >supprimer</a></td>
                    </tr>
                @endforeach
            </table>
        @endif
        <a href="add">Créer un nouveau utilisateur</a>
    </div>
@stop
