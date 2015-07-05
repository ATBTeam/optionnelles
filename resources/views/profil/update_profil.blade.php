<form method="POST" action="{{ $profil->id }}">
    {!! csrf_field() !!}

    <div>
        Intitulé
        <input type="text" name="intitule" value="{{ $profil->intitule }}" placeholder="Intitulé de profil">
        @if ($errors->has('intitule')) <p>{{ $errors->first('intitule') }}</p> @endif
        @if (isset($erreurs))
            @if (count($erreurs) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($erreurs as $erreur)
                            <li>{{ $erreur }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
    </div>

    <div>
        <button type="submit">Ajouter</button>
    </div>
</form>