@extends('layouts/auth')
@section('title', 'Bienvenue')
@section('content')
    
<div class="login_action">
    <img src="/img/icons/menu_bottles.svg" alt="Icône cellier">
    <h3>Remplissez votre cellier dès maintenant !</h3>
    <a href="{{ route('login') }}" class="button info">Se connecter</a>
    <div>
        <p>Pas encore inscrit ?</p>
        <a href="{{ route('register') }}" class="link underline">S'enregistrer</a>
    </div>
</div>

@if(session('message'))
    <h6 class="success-message">
        {{ session('message') }}
    </h6>
@endif

@endsection