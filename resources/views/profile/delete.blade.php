@extends('layouts/app')
@section('title', 'Supprimer mon Profil')
@section('content')
<section>

        <x-auth-validation-errors :errors="$errors"/>

        <!-- Retour -->
        <a href="{{route('profile.index')}}" class="">← Retour</a>
        
        <h2>Supprimer mon compte</h2>

        <form method="post" action="{{ route('profile.delete') }}" class="p-6">
            @csrf
            @method('delete')

            <p>Veuillez entrez votre mot de passe afin de confirmer la suppression de votre compte.</p>
           
            <!-- Password -->
            <div class="form_element">
                <x-input-label for="password" :value="__('Mot de passe')" />

                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />

            </div>

            <!-- Confirm Password -->
            <div class="form_element">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />

            </div>

            <x-primary-button class="button danger">
                {{ __("Supprimer") }}
            </x-primary-button>
        </form>
 
</section>
@endsection
