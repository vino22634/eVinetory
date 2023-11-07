@extends('layouts/auth')
@section('title', 'Envoi du lien de récupération de mot de passe')
@section('content')
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __("Vous avez oublié votre mot de passe? Pas de problème. Indiquez-nous juste votre adresse courriel et nous vous enverrons un lien pour réinitialiser votre mot de passe et vous permettre d'en choisir un nouveau.") }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-label mt-4">
            <x-input-label for="email" :value="__('Courriel')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Lien Courriel pour réinitialiser votre mot de passe') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection
