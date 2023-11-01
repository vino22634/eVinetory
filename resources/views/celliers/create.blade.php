@extends('layouts/app')
@section('title', 'Créer un cellier')
@section('content')

<style>
    section {
        padding: 2rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .form_element {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    label {
        font-weight: bold;
    }

    input {
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.5rem;

    }
</style>
<section>
    <!-- Retour -->
    <a href="{{route('celliers.index')}}" class="">← Retour</a>

    <h2>Créer un cellier</h2>

    <!-- Formulaire ajout cellier -->
    <form method="post">
        @csrf
        <div class="form_element">
            <label for="location">Localisation</label>
            <input type="text" id="location" name="location" value="{{old('location')}}" required>
        </div>
        <div class="form_element">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="{{old('description')}}">
        </div>
        <input type="submit" class="button" value="Ajouter">
    </form>

</section>

@endsection