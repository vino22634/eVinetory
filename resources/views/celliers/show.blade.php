@extends('layouts/app')
@section('title', 'Détail du cellier')
@section('content')

<script src="{{ asset('js/sort.js') }}" defer></script>
<script src="{{ asset('js/modale.js') }}" defer></script>
<link href="{{ asset('css/components/cardBouteilleCellier.css') }}" rel="stylesheet">
<link href="{{ asset('css/components/modale.css') }}" rel="stylesheet">
<link href="{{ asset('css/cellier__detail.css') }}" rel="stylesheet">


<style>
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
            <a href="#" id="modaleTrigger" class="">Supprimer le cellier</a>
        </div>
    </div>

    <!-- Ajouter une bouteille au cellier -->
    <a href="{{route('bouteilles.list')}}" class="button info">Ajouter une bouteille</a>

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
    <div class="cards-container">
        @forelse($cellier->detailsBouteillesCellier as $detailBouteilleCellier)
            <x-celliers.cardBouteilleCellier-component :detailBouteilleCellier="$detailBouteilleCellier" />
        @empty
        <li>Vous n'avez pas encore de bouteilles dans ce cellier</li>
        @endforelse
</div>

</section>

<!-- Modal confirmation suppression-->
<div class="modale" id="modaleSupp" tabindex="-1" aria-labelledby="ModaleSupp" aria-hidden="true">
    <div class="modale-content">
        <h3>Voulez-vous vraiment supprimer votre cellier ?</h3>
        <div class="modaleCTA">
            <button class="closeButton info">Non</button>
            <!-- Form -->
            <form method="post">
                @method('DELETE')
                @csrf
                <input type="submit" value="Supprimer" class="button danger">
            </form>
        </div>
    </div>
</div>

@endsection