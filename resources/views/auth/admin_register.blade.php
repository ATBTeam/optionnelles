<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>

<!-- resources/views/auth/register.blade.php -->

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
        Type de profil
        <select name="profil">
            <option value="0">Choisir votre profil</option>
            @if (isset($profils))
                @foreach ($profils as $profil)
                    @if(old('profil') == $profil->id)
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
        Nom
        <input type="text" name="nom" value="{{ old('nom') }}" placeholder="Votre nom">
        @if ($errors->has('nom')) <p>{{ $errors->first('nom') }}</p> @endif
    </div>

    <div>
        Prénom
        <input type="text" name="prenom" value="{{ old('prenom') }}" placeholder="Votre prénom">
        @if ($errors->has('prenom')) <p>{{ $errors->first('prenom') }}</p> @endif
    </div>

    <div>
        Email
        <input type="email" name="mail" value="{{ old('mail') }}" placeholder="Votre email">
        @if ($errors->has('mail')) <p>{{ $errors->first('mail') }}</p> @endif
    </div>

    <div>
        Login
        <input type="text" name="login" value="{{ old('login') }}" placeholder="Votre login">
        @if ($errors->has('login')) <p>{{ $errors->first('login') }}</p> @endif
    </div>

    <div>
        Mot de passe
        <input type="password" name="mdp1" placeholder="Votre mot de passe">
        @if ($errors->has('mdp1')) <p>{{ $errors->first('mdp1') }}</p> @endif
    </div>

    <div>
        Retapez votre mot de passe
        <input type="password" name="mdp2" placeholder="Confirmez votre mot de passe">
        @if ($errors->has('mdp2')) <p>{{ $errors->first('mdp2') }}</p> @endif
    </div>

    <div>
        <button type="submit">S'inscrire</button>
    </div>
</form>

</body>
</html>