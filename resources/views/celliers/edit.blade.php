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

    input,
    textarea {
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
    <a href="{{route('cellier.show', $cellier->id)}})" class="">← Retour</a>

    <h2>Modifier le cellier « {{$cellier->name}} »</h2>

    <!-- Formulaire modifiant un cellier -->
    <form method="post">
                    @csrf
                    @method('put')
        <div class="form_element">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{$cellier->name}}" required>
            @if($errors->has('name'))
            <div class="text_error">
                {{$errors->first('name')}}
            </div>
            @endif
        </div>
        <div class="form_element">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10">{{$cellier->description}}</textarea>
            @if($errors->has('description'))
            <div class="text_error">
                {{$errors->first('description')}}
            </div>
            @endif
        </div>
        <input type="submit" class="button info" value="Modifier">
    </form>

</section>

@endsection