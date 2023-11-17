@extends('layouts/app')
@section('title', 'Modifier mon Profil')
@section('content')

<section>

    <!-- Retour -->
    <a href="{{route('profile.index')}}" class="">← Retour</a>

    <h2>Modifier mes informations</h2>

    <form method="POST" action="{{ route('profile.update') }}" class="form-control">
        @method('PUT')
        @csrf

        <!-- Name -->
        <div class="form_element">
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" type="text" name="name" value="{{ auth()->user()->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div class="form_element">
            <x-input-label for="email" :value="__('Courriel')" />
            <x-text-input id="email" type="email" name="email" value="{{ auth()->user()->email }}" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="form_element">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="form_element">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>
        <div class="profile_button">
            <x-primary-button class="button info">
                {{ __("Mettre à jour") }}
            </x-primary-button> 
        </div>
    </form>
    
</section>
@endsection