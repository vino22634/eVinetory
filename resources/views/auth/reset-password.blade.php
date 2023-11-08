@extends('layouts/auth')
@section('title', 'Réinitialisation du mot de passe')
@section('content')
<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="input-label">
            <x-input-label for="email" :value="__('Courriel')" />
            <x-text-input id="email" class="text_input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="input-label">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="text_input" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="input-label">
            <x-input-label for="password_confirmation" :value="__('Retapez votre mot de passe')" />

            <x-text-input id="password_confirmation" class="text_input"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="button_form">
            <x-primary-button class="button info">
                {{ __('Confirmez votre mot de passe') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection
