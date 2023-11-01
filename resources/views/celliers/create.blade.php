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

    .text_error {
        color: var(--color-light-red);
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
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{old('name')}}" required>
            @if($errors->has('name'))
            <div class="text_error">
                {{$errors->first('name')}}
            </div>
            @endif
        </div>
        <div class="form_element">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="{{old('description')}}">
            @if($errors->has('description'))
            <div class="text_error">
                {{$errors->first('description')}}
            </div>
            @endif
        </div>
        <input type="submit" class="button" value="Ajouter">
    </form>

</section>

@endsection