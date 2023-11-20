@extends('layouts/app')
@section('title', 'Mon Profil')
@section('content')

<div class="profile_info">
    
    <h2>Mes informations</h2>

    <section class="form-control">
        @csrf
    
        <!-- Name -->
        <div class="form_element">
            <x-input-label for="name" :value="__('Nom :')" />
            <x-text-input id="name" type="text" name="name" value="{{ auth()->user()->name }}" required autofocus autocomplete="name" readonly />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div class="form_element">
            <x-input-label for="email" :value="__('Courriel :')" />
            <x-text-input id="email" type="email" name="email" value="{{ auth()->user()->email }}" required autocomplete="username" readonly/>
            <x-input-error :messages="$errors->get('email')" />
        </div>
    </section>

    <section>
        <div class="profile_button">
            <a href="{{ route('profile.edit') }}"><x-primary-button class="button info">
                {{ __("Modifier") }}
            </x-primary-button></a>

            <a href="{{ route('profile.delete') }}"><x-primary-button class="button danger">
                {{ __("Supprimer") }}
            </x-primary-button></a>

        </div>
    </section>

    @if(session('message'))
    <h6 class="success-message">
        {{ session('message') }}
    </h6>
    @endif

    <div class="login-action">
        <div>
            <a href="" class="link">Nous contacter</a>
        </div>
        <div>
            <a href="{{ route('logout') }}" class="link">Se déconnecter</a>
        </div>
    </div>

</div>

@endsection