@extends('layouts/auth')
@section('title', 'Envoi du lien de récupération de mot de passe')
@section('content')

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" class="auth_session_status" />

    <form method="POST" action="{{ route('password.email') }}" class="container_auth_form">
        @csrf

        <p>
        {{ __("Vous avez oublié votre mot de passe? Pas de problème. Indiquez-nous juste votre adresse courriel et nous vous enverrons un lien pour réinitialiser votre mot de passe et vous permettre d'en choisir un nouveau.") }}
        </p>

        <!-- Email Address -->
        <div class="form_element">
            <x-input-label for="email" :value="__('Courriel')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="text_error" />
        </div>
        <x-primary-button class="button info">
            {{ __("M'envoyer un lien par courriel") }}
        </x-primary-button>
    </form>
</x-guest-layout>
</div>

@endsection
