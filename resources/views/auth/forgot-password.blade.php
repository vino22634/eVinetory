@extends('layouts/auth')
@section('title', 'Envoi du lien de récupération de mot de passe')
@section('content')
<x-guest-layout>
    <div>
        {{ __("Vous avez oublié votre mot de passe? Pas de problème. Indiquez-nous juste votre adresse courriel et nous vous enverrons un lien pour réinitialiser votre mot de passe et vous permettre d'en choisir un nouveau.") }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-label">
            <x-input-label for="email" :value="__('Courriel')" />
            <x-text-input id="email" class="text_input" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="button_form">
            <x-primary-button class="button info">
                {{ __('Lien Courriel pour réinitialiser votre mot de passe') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection
