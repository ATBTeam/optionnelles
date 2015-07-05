<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
@if (isset($actif))
    <div class="alert alert-danger">
        <ul>
            <li>Votre compte n'est pas encore activé !</li>
        </ul>
    </div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- resources/views/auth/login.blade.php -->

<form method="POST" action="login">
    {!! csrf_field() !!}

    <div>
        Login
        <input type="text" name="login" value="{{ old('login') }}">
        @if ($errors->has('login')) <p>{{ $errors->first('login') }}</p> @endif
    </div>

    <div>
        Mot de passe
        <input type="password" name="mdp">
        @if ($errors->has('mdp')) <p>{{ $errors->first('mdp') }}</p> @endif
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Se connecter</button>
    </div>
</form>

</body>
</html>