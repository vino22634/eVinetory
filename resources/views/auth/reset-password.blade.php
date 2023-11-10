@extends('layouts/auth')
@section('title', 'Réinitialisation du mot de passe')
@section('content')
<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="container_auth_form">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form_element">
            <x-input-label for="email" :value="__('Courriel')" />
            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="text_error"/>
        </div>

        <!-- Password -->
        <div class="form_element">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="text_error" />
        </div>

        <!-- Confirm Password -->
        <div class="form_element">
            <x-input-label for="password_confirmation" :value="__('Retapez votre mot de passe')" />

            <x-text-input id="password_confirmation"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="text_error"/>
        </div>

        <div class="button_reset_form">
            <x-primary-button class="button info button_reset">
                {{ __('Confirmez votre mot de passe') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
@endsection
