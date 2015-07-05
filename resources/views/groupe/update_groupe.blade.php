<form method="POST" action="{{ $groupe->id }}">
    {!! csrf_field() !!}

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div>
        Année suivie
        <select name="parcours">
            <option value="0">Choisir un parcours</option>
            @if (isset($parcours))
                @foreach ($parcours as $parc)
                    @if($groupe->parcours->id == $parc->id)
                        <option selected value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                    @else
                        <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                    @endif
                @endforeach
            @endif
        </select>
        @if ($errors->has('parcours')) <p>{{ $errors->first('parcours') }}</p> @endif
    </div>

    <div>
        Intitulé
        <input type="text" name="intitule" value="{{ $groupe->intitule }}" placeholder="Intitulé de profil">
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