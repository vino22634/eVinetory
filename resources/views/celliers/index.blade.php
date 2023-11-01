@extends('layouts/app')
@section('title', 'Celliers')
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
    <h2>Mes celliers</h2>

    <!-- Liste de mes cellier -->
    <div>
        <ul>
            @forelse($celliers as $cellier)
            <li><a href="{{route('cellier.show', $cellier->id)}}" class="">{{ucfirst($cellier->name)}}</a></li>
            @empty
            <li>Vous n'avez pas encore de cellier</li>
            @endforelse
        </ul>
    </div>

    <!-- Créer un nouveau cellier -->
    <a href="{{route('cellier.create')}}" class="button">Créer un cellier</a>

</section>

@endsection