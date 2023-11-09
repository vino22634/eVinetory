@extends('layouts/app')
@section('title', 'Créer un cellier')
@section('content')

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
            <textarea name="description" id="description" cols="30" rows="10">{{old('description')}}</textarea>
            @if($errors->has('description'))
            <div class="text_error">
                {{$errors->first('description')}}
            </div>
            @endif
        </div>
        <input type="submit" class="button info" value="Ajouter">
    </form>

</section>

@endsection