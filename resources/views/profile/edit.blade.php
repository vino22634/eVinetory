@extends('layouts/app')
@section('title', 'Modifier mon Profil')
@section('content')

<section>

    <x-auth-validation-errors :errors="$errors"/>

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
        </div>

        <!-- Email Address -->
        <div class="form_element">
            <x-input-label for="email" :value="__('Courriel')" />
            <x-text-input id="email" type="email" name="email" value="{{ auth()->user()->email }}" required autocomplete="username" />
        </div>

        <div class="profile_button">
            <x-primary-button class="button warning">
                {{ __("Mettre à jour") }}
            </x-primary-button> 
        </div>
    </form>
</section>
@endsection