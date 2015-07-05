<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
</head>
<body>
<p>Nom : {{ $user->nom }}</p>
<p>Prénom : {{ $user->prenom }}</p>
<p>Email : {{ $user->mail }}</p>
<p>Login : {{ $user->login }}</p>
<p>Mot de passe : {{ $user->mdp }}</p>
<p>Profil : {{ $user->profil->intitule }}</p>
</body>
</html>