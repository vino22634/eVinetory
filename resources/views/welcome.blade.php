@extends('layouts/auth')
@section('title', 'Bienvenue')
@section('content')

<div class="login_action">
    <img src="/img/icons/menu_bottles.svg" alt="Icône cellier">
    <h3>Remplissez votre cellier dès maintenant !</h3>
    <a href="{{ route('login') }}" class="button info">Se connecter</a>
    <div>
        <p>Pas encore inscrit ?</p>
        <a href="{{ route('register') }}" class="link">S'enregistrer</a><br>
       
        <a href="mailto:evinetory@gmail.com?subject=Signaler%20une%20erreur&body=Merci%20pour%20vos%20services.%20Je%20souhaite%20vous%20signaler%20une%20erreur%20concernant:%" class="link">Signaler une erreur</a> <br><br><br>

        <a href="#" class="button info">Contactez-nous</a>
    </div>
</div>

@endsection