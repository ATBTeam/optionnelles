<table border="1px">
    <tr>
        <td>Id</td>
        <td>Nom</td>
        <td>Prénom</td>
        <td>Email</td>
        <td>Login</td>
        <td>Mot de passe</td>
        <td>Profil</td>
        <td>Groupe</td>
        <td>Parcours</td>
        <td>Activé</td>
        <td>Modifier</td>
        <td>Supprimer</td>
    </tr>
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
<a href="add">Ajouter un nouvel utilisateur</a>