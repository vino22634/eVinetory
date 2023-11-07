@extends('layouts/app')
@section('title', 'Détail du cellier')
@section('content')

<script src="{{ asset('js/sort.js') }}" defer></script>
<link href="{{ asset('css/components/bouteilleCellierCard.css') }}" rel="stylesheet">

<style>
    .cellier__detail {
        border-radius: 10px;
        padding: 1rem;
        background-color: var(--color-light-pink);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        color: black;
    }

    .cellier__detail-cta {
        display: flex;
        flex: 1;
        gap: 1rem;
        justify-content: space-between;
    }

    .cellier__tri {
        margin-top: 1rem;
        margin-left: auto;
    }
</style>

<section>
    <h2>Mes celliers</h2>
    <!-- Retour -->
    <a href="{{route('celliers.index')}}" class="">← Retour</a>

    <!-- Détail cellier -->
    <div class="cellier__detail">
        <h2>{{ucfirst($cellier->name)}}</h2>
        @if($cellier->description)
        <p>{{ucfirst($cellier->description)}}</p>
        @endif
        @if($cellier->bouteillesCellier->count() > 0)
        <p>Nombre de bouteilles : {{$cellier->bouteillesCellier->sum('quantite')}}</p>
        @endif
        <!-- CTA -->
        <div class="cellier__detail-cta">
            <a href="{{route('cellier.edit', $cellier->id)}}" class="">Modifier le cellier</a>
            <a href="#" class="">Supprimer le cellier</a>
        </div>
    </div>

    <!-- Ajouter une bouteille au cellier -->
    <a href="{{route('bouteilles.list')}}" class="button">Ajouter une bouteille</a>

    @if($cellier->bouteillesCellier->count() > 0)
    <!-- Trier les bouteilles -->
    <div class="cellier__tri">
        <label for="tri">Trier les bouteilles par : </label>
        <select name="tri" id="tri">
            <option value="nom">Nom</option>
            <option value="quantite">Quantité</option>
            <option value="prix">Prix</option>
        </select>
    </div>
    @endif

    <!-- Détail bouteilles -->
    <ul class="bouteilleCellier__card-container">
        @forelse($cellier->detailsBouteillesCellier as $detailBouteilleCellier)
        <li class="bouteilleCellier__card">

            <!-- Image -->
            <!-- if the img source doesn't contain the word 'http', then load this image : /img/icons/bottle.png -->
            @if(!Str::contains($detailBouteilleCellier->image, 'http') || Str::contains($detailBouteilleCellier->image, 'pastille'))
            <img src="/img/icons/bottle.png" alt="{{ $detailBouteilleCellier->nom }}" class="bouteille">
            @else
            <img src="{{ $detailBouteilleCellier->image }}" alt="{{ $detailBouteilleCellier->nom }}" class="bouteille">
            @endif

            <!-- Détails -->
            <div class="bouteilleCellier__card-details">
                <div id="bouteille-nom">{{ $detailBouteilleCellier->nom }}</div>
                <div>{{ Str::before($detailBouteilleCellier->description, 'Code') }}</div>
                <div id="bouteille-prix">{{ $detailBouteilleCellier->prix_saq }} $</div>
            </div>

            <!-- Quantité -->
            <img src="/img/icons/delete.svg" alt="supprimer" class="icons">
            <div class="bouteilleCellier__card-quantity">
                <span>-</span>
                <span id="bouteille-quantite">{{ $detailBouteilleCellier->pivot->quantite }}</span>
                <span>+</span>
            </div>
        </li>
        @empty
        <li>Vous n'avez pas encore de bouteilles dans ce cellier</li>
        @endforelse
    </ul>

</section>

@endsection