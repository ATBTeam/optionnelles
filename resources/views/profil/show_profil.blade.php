<table border="1px">
    <tr>
        <td>Id</td>
        <td>Intitulé</td>
        <td>Modifer</td>
        <td>Supprimer</td>
    </tr>
    @foreach($profils as $profil)
        <tr>
            <td>{{ $profil->id }}</td>
            <td>{{ $profil->intitule }}</td>
            <td><a href="update/{{ $profil->id }}" >modifier</a></td>
            <td><a href="delete/{{ $profil->id }}" >supprimer</a></td>
        </tr>
    @endforeach
</table>
<a href="add">Ajouter un nouveau profil</a>