<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

</head>

<body>
    <div class="container login">
        <div class="login_logo">
            <img src="/img/logo.png" alt="Logo eVinetory">
            <h1>eVinetory</h1>
            <h2>Collectionnez les saveurs</h2>
        </div>
        <div class="login_action">
            <img src="/img/icons/menu_bottles.svg" alt="Icône cellier">
            <h3>Remplissez votre cellier dès maintenant !</h3>
            <button><a href="{{ route('login') }}" class="button">Se connecter</a></button>
            <div>
                <p>Pas encore inscrit ?</p>
                <a href="{{ route('register') }}" class="link">S'enregistrer</a>
            </div>
        </div>
    </div>
</body>

</html>