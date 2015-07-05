<form method="POST" action="add">
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
                    @if(old('parcours') == $parc->id)
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
        <input type="text" name="intitule" value="{{ old('intitule') }}" placeholder="Intitulé du groupe">
        @if ($errors->has('intitule')) <p>{{ $errors->first('intitule') }}</p> @endif
    </div>

    <div>
        <button type="submit">Ajouter</button>
    </div>
</form>