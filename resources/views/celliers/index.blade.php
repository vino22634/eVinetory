@extends('layouts/app')
@section('title', 'Celliers')
@section('content')

<!-- Styles -->
<link href="/css/components/cardCellier.css" rel="stylesheet">

<section>
    <h2>Mes celliers</h2>

    <!-- Liste de mes cellier -->
    <div class="cards-container">
        @forelse($celliers as $cellier)
        <a class="cardCellier" href="{{route('cellier.show', $cellier->id)}}">
            <h3>{{ucfirst($cellier->name)}}</h3>
            <span><img src="img/icons/menu_bottles.svg" alt="">x {{$cellier->bouteillesCellier->sum('quantite')}}</span>
        </a>
        @empty
        <p>Vous n'avez pas encore de cellier</p>
        @endforelse
    </div>

    <!-- Créer un nouveau cellier -->
    <a href="{{route('cellier.create')}}" class="button info">Ajouter un cellier</a>
</section>

@endsection