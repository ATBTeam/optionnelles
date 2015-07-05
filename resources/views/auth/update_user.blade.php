<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>

<!-- resources/views/auth/register.blade.php -->
<form method="POST" action="{{ $user->id }}">
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
        Type de profil
        <select name="profil">
            <option value="0">Choisir un profil</option>
            @if (isset($profils))
                @foreach ($profils as $profil)
                    @if($user->profil->id == $profil->id)
                        <option selected value="{{ $profil->id }}">{{ $profil->intitule }}</option>
                    @else
                        <option value="{{ $profil->id }}">{{ $profil->intitule }}</option>
                    @endif
                @endforeach
            @endif
        </select>
        @if ($errors->has('profil')) <p>{{ $errors->first('profil') }}</p> @endif
    </div>

    <div>
        Année suivie
        <select name="parcours">
            <option value="0">Choisir un parcours</option>
            @if (isset($parcours))
                @if(isset($user->parcours->id))
                    @foreach ($parcours as $parc)
                        @if($user->parcours->id == $parc->id)
                            <option selected value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                        @else
                            <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                        @endif
                    @endforeach
                @else
                    @foreach ($parcours as $parc)
                        <option value="{{ $parc->id }}">{{ $parc->intitule }}</option>
                    @endforeach
                @endif
            @endif
        </select>
        @if ($errors->has('parcours')) <p>{{ $errors->first('parcours') }}</p> @endif
    </div>

    <div>
        Groupe
        <select name="groupe">
            <option value="0">Choisir un groupe</option>
            @if (isset($groupes))
                @if(isset($user->groupe->id))
                    @foreach ($groupes as $groupe)
                        @if($user->groupe->id == $groupe->id)
                            <option selected value="{{ $groupe->id }}">{{ $groupe->intitule }}</option>
                        @else
                            <option value="{{ $groupe->id }}">{{ $groupe->intitule }}</option>
                        @endif
                    @endforeach
                @else
                    @foreach ($groupes as $groupe)
                        <option value="{{ $groupe->id }}">{{ $groupe->intitule }}</option>
                    @endforeach
                @endif
            @endif
        </select>
        @if ($errors->has('groupe')) <p>{{ $errors->first('groupe') }}</p> @endif
    </div>

    <div>
        Ues</br>
        @if(isset($user->uesEnseignees[0]))
            @foreach($ues as $ue)
                <span style="display:none;">{{ $check = false }}</span>
                @foreach($user->uesEnseignees as $uE)
                    @if($ue->id == $uE->id)
                        {{ $ue->intitule }}<input checked type="checkbox" name="ues[]" value="{{ $ue->id }}" />
                        <span style="display:none;">{{ $check = true }}</span>
                    @endif
                @endforeach
                @if($check==false)
                    {{ $ue->intitule }}<input type="checkbox" name="ues[]" value="{{ $ue->id }}" >
                @endif
                <span style="display:none;">{{ $check = false }}</span>
            @endforeach
        @else
            @foreach($ues as $ue)
                {{ $ue->intitule }}<input type="checkbox" name="ues[]" value="{{ $ue->id }}" />
            @endforeach
        @endif
    </div>

    <div>
        Nom
        <input type="text" name="nom" value="{{ $user->nom }}" placeholder="Nom">
        @if ($errors->has('nom')) <p>{{ $errors->first('nom') }}</p> @endif
    </div>

    <div>
        Prénom
        <input type="text" name="prenom" value="{{ $user->prenom }}" placeholder="Prénom">
        @if ($errors->has('prenom')) <p>{{ $errors->first('prenom') }}</p> @endif
    </div>

    <div>
        Email
        <input type="email" name="mail" value="{{ $user->mail }}" placeholder="Email">
        @if ($errors->has('mail')) <p>{{ $errors->first('mail') }}</p> @endif
    </div>

    <div>
        Login
        <input type="text" name="login" value="{{ $user->login }}" placeholder="Login">
        @if ($errors->has('login')) <p>{{ $errors->first('login') }}</p> @endif
    </div>

    <div>
        Mot de passe
        <input type="password" name="mdp" placeholder="Nouveau mot de passe">
        @if ($errors->has('mdp')) <p>{{ $errors->first('mdp') }}</p> @endif
    </div>

    <div>
        Activé
        @if($user->actif == 1)
            <input checked type="checkbox" name="actif" value="1">
        @else
            <input type="checkbox" name="actif" value="1">
        @endif
    </div>

    <div>
        <button type="submit">Enregistrer</button>
    </div>
</form>

</body>
</html>