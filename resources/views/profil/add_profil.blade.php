<form method="POST" action="add">
    {!! csrf_field() !!}

    <div>
        Intitulé
        <input type="text" name="intitule" value="{{ old('intitule') }}" placeholder="Intitulé de profil">
        @if ($errors->has('intitule')) <p>{{ $errors->first('intitule') }}</p> @endif
    </div>

    <div>
        <button type="submit">Ajouter</button>
    </div>
</form>