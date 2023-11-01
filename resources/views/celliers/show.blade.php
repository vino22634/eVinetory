@extends('layouts/app')
@section('title', 'Détail du cellier')
@section('content')

<style>
    section {
        padding: 2rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
</style>
<section>
    <!-- Retour -->
    <a href="{{route('celliers.index')}}" class="">← Retour</a>

    <h2>{{ucfirst($cellier->name)}}</h2>

    <!-- Détail cellier -->
    <p>{{ucfirst($cellier->description)}}</p>

    <!-- Détail bouteilles -->
    <ul>
        @forelse($cellier->bouteillesCellier as $bouteilleCellier)
        <li>
            <a href="" class="">{{ucfirst($bouteilleCellier->bouteille->nom)}}</a>
        </li>
        @empty
        <li>Vous n'avez pas encore de bouteilles dans ce cellier</li>
        @endforelse
    </ul>

    <!-- Ajouter une bouteille au cellier -->
    <a href="{{route('bouteilles.list')}}" class="button">Ajouter une bouteille</a>

    <!-- Modifier le cellier -->
    <a href="" class="button">Modifier le cellier</a>
    <!-- Supprimer le cellier -->
    <a href="" class="button">Supprimer le cellier</a>

</section>

@endsection