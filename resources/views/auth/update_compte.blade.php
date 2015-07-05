<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>

<!-- resources/views/auth/register.blade.php -->

<form method="POST" action="update">
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

    <div>
        Nom
        <input type="text" name="nom" value="{{ $user->nom }}" placeholder="Votre nom">
        @if ($errors->has('nom')) <p>{{ $errors->first('nom') }}</p> @endif
    </div>

    <div>
        Prénom
        <input type="text" name="prenom" value="{{ $user->prenom }}" placeholder="Votre prénom">
        @if ($errors->has('prenom')) <p>{{ $errors->first('prenom') }}</p> @endif
    </div>

    <div>
        Email
        <input type="email" name="mail" value="{{ $user->mail }}" placeholder="Votre email">
        @if ($errors->has('mail')) <p>{{ $errors->first('mail') }}</p> @endif
    </div>

    <div>
        Login
        <input type="text" name="login" value="{{ $user->login }}" placeholder="Votre login">
        @if ($errors->has('login')) <p>{{ $errors->first('login') }}</p> @endif
    </div>

    <div>
        Tapez votre mot de passe
        <input type="password" name="mdp1" placeholder="Votre mot de passe">
        @if ($errors->has('mdp1')) <p>{{ $errors->first('mdp1') }}</p> @endif
    </div>

    <div>
        Tapez votre nouveau mot de passe
        <input type="password" name="mdp2" placeholder="Votre nouveau mot de passe">
        @if ($errors->has('mdp2')) <p>{{ $errors->first('mdp2') }}</p> @endif
    </div>

    <div>
        <button type="submit">Mettre à jours</button>
    </div>
</form>

</body>
</html>