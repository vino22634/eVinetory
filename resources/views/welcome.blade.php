@extends('layouts/auth')
@section('title', 'Bienvenue')
@section('content')
    
<div class="login_action">
    <img src="/img/icons/menu_bottles.svg" alt="Icône cellier" class="logo">
    <h3>Remplissez votre cellier dès maintenant !</h3>
    <a href="{{ route('login') }}" class="button info">Se connecter</a>
    <div>
        <p>Pas encore inscrit ?</p>
        <a href="{{ route('register') }}" class="link underline">S'enregistrer</a>
    </div>
    <div class="login_mailto">
        <a href="mailto:evinetory@gmail.com" class="link"><img src="/img/icons/icon-mail.png" alt="envoi mail" title="Nous contacter" class="mail-icon">Contactez-nous</a>
    </div>
</div>

@if(session('message'))
    <h6 class="success-message">
        {{ session('message') }}
    </h6>
@endif

@endsection