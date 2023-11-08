@extends('layouts/auth')
@section('title', 'Inscription')
@section('content')
    <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="input-label">
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="text_input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <!-- Email Address -->
            <div class="input-label">
                <x-input-label for="email" :value="__('Courriel')" />
                <x-text-input id="email" class="text_input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div class="input-label">
                <x-input-label for="password" :value="__('Mot de passe')" />

                <x-text-input id="password"
                                type="password"
                                name="password"
                                class="text_input"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Confirm Password -->
            <div class="input-label">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

                <x-text-input id="password_confirmation" 
                                type="password"
                                class="text_input"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')"  />
            </div>

            <div class="button_form">
                <a href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="button info">
                    {{ __("S'inscrire") }}
                </x-primary-button>
            </div>
    </form>
@endsection