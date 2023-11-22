@extends('layouts/app')
@section('title', 'Mon Profil')
@section('content')
<section>
    <h2>Mes informations</h2>

    <div class="profil__detail">
        <p><strong>Nom: </strong>{{auth()->user()->name}}</p>
        <p><strong>Courriel:  </strong>{{ auth()->user()->email }}</p>
        <a href="{{ route('profile.edit') }}" class="link blue">Modifier mon profil</a>
        <a href="{{ route('password.request') }}" class="link blue">Modifier mon mot de passe</a>
        <a href="{{ route('profile.delete') }}" class="link red">Supprimer mon profil</a>
    </div>

    @if(session('message'))
    <h6 class="success-message">
        {{ session('message') }}
    </h6>
    @endif

    <div class="profil__detail-cta">
        <a href="{{ route('logout') }}" class="button">Se déconnecter</a>
        <!-- <a href="mailto:evinetory@gmail.com" class="button">Nous contacter</a> -->
        <!-- <div class="login_mailto"> -->
            <a href="mailto:evinetory@gmail.com" class="link"><img src="/img/icons/icon-mail.png" alt="envoi mail" title="Nous contacter" class="mail-icon">Contactez-nous</a>
        <!-- </div> -->
    </div>

    </div>

</section>
@endsection