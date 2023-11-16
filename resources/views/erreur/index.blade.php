@extends('layouts/app')
@section('title', 'Créer cellier')
@section('content')

<section>
    <!-- Retour -->
    <a href="#retournerversprofil" class="">← Retour</a>

    <h2>Formulaire de contact</h2>
    <p>Merci de nous indiquer vos commentaires, suggestions,  demande de renseignements et éventuellement nous signaler une erreur que vous auriez constatée</p>

    <!-- Formulaire ajout erreur -->
    <form method="post">
        @csrf
        <div class="form_element">
            <label for="name">Titre</label>
            <input type="text" id="subject" name="subject" value="{{old('name')}}" required>
            @if($errors->has('name'))
            <div class="text_error">
                {{$errors->first('name')}}
            </div>
            @endif
        </div>
        <div class="form_element">
            <label for="description">Description</label>
            <textarea name="body" id="body" cols="30" rows="10">{{old('description')}}</textarea>
            @if($errors->has('description'))
            <div class="text_error">
                {{$errors->first('description')}}
            </div>
            @endif
        </div>
        <input type="submit" class="button info" value="Envoyer">
    </form>

</section>

@endsection