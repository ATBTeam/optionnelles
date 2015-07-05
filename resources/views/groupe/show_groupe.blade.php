<table border="1px">
    <tr>
        <td>Id</td>
        <td>Intitulé</td>
        <td>Parcours</td>
        <td>Modifer</td>
        <td>Supprimer</td>
    </tr>
    @foreach($groupes as $groupe)
        <tr>
            <td>{{ $groupe->id }}</td>
            <td>{{ $groupe->intitule }}</td>
            <td>{{ $groupe->parcours->intitule }}</td>
            <td><a href="update/{{ $groupe->id }}" >modifier</a></td>
            <td><a href="delete/{{ $groupe->id }}" >supprimer</a></td>
        </tr>
    @endforeach
</table>
<a href="add">Ajouter un nouveau groupe</a>