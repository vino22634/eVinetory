@extends('layouts/app')
@section('title', 'Créer cellier')
@section('content')

<section>
    <!-- Retour -->
    <a href="{{route('profile.index')}}" class="">← Retour</a>

    <h2>Formulaire de contact</h2>
    <p>Merci de nous indiquer vos commentaires, suggestions,  demande de renseignements et éventuellement nous signaler une erreur que vous auriez constatée</p>

    <!-- Formulaire ajout erreur -->
    <form method="post" action="{{ route('erreur.send') }}">
    @csrf
    <div class="form_element">
        <label for="subject">Titre</label>
        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required>
        @if($errors->has('subject'))
        <div class="text_error">
            {{ $errors->first('subject') }}
        </div>
        @endif
    </div>
    <div class="form_element">
        <label for="body">Description</label>
        <textarea name="body" id="body" cols="30" rows="10">{{ old('body') }}</textarea>
        @if($errors->has('body'))
        <div class="text_error">
            {{ $errors->first('body') }}
        </div>
        @endif
    </div>
    <input type="submit" class="button info" value="Envoyer">
</form>

</section>

@endsection