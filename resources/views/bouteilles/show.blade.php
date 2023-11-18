@extends('layouts/app')
@section('title', 'Détail bouteille')
@section('content')

<script src="{{ asset('js/utils.js') }}" defer></script>
<script src="{{ asset('js/bouteilles.js') }}" defer></script>
<script src="{{ asset('js/bouteilleDetails.js') }}" defer></script>

<script src="{{ asset('js/modale.js') }}" defer></script>
<link href="{{ asset('css/components/modale.css') }}" rel="stylesheet">

<style>
    .detailsBouteille, .detailsCellier {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem 0;
        flex-wrap: wrap;
    }

    .detailsCellier {
        flex-direction: column;
    }

    .detailsBouteille__info {
        flex: 1;
        flex-basis: 200px;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .detailsBouteille img {
        max-height: clamp(200px, 30vw, 400px);
    }

    .detailsBouteille__pastille {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        
    }

    .cardBouteilleCellier-quantity {
        display: flex;
        gap: 1rem;
        background-color: var(--color-light-pink);
        border-radius: 10px;
        padding: 0.5rem 1rem;
        justify-content: space-between;
        align-items: center;
    }

    .cardBouteilleCellier-quantity span:nth-child(2) {
        font-weight: 600;
    }

</style>

<section>
    <!-- Retour -->
    <a href="{{route('bouteilles.list')}}" class="">← Retour</a>

    <!-- Détail bouteille -->
    <div class="detailsBouteille" id="idbouteille" data-bouteilleid="{{ $bouteille->id }}">
        <!-- Image -->
        <!-- si l'image source ne contient pas le mot 'http', on load cette image par défaut : /img/icons/bottle.png -->
        @if(!Str::contains($bouteille->image, 'http') || Str::contains($bouteille->image, 'pastille'))
            <img src="/img/icons/bottle.png" alt="{{ $bouteille->nom }}">
        @else
            <img src="{{ Str::before($bouteille->image, '?') }}?width=367&height=550" alt="{{ $bouteille->nom }}">
        @endif

        <!-- Infos saq -->
        <div class="detailsBouteille__info">
            <h2>{{ $bouteille->nom }}</h2>

            @if ($bouteille->pastilleType )
                <div class="detailsBouteille__pastille">
                    <img src="{{ $bouteille->pastilleType->imageURL }}" alt="Pastille">
                    <span>{{ Str::after($bouteille->pastilleType->description, ' : ') }}</span>
                </div>
            @endif
                
            <div>
                {{ ($bouteille->type ==1) ? 'Vin rouge' : 'Vin blanc' }}, {{ $bouteille->format }},
                {{ $bouteille->pays }}
            </div>

            <div>{{ $bouteille->prix_saq }}$</div>

            <!-- CTA -->
            <div>
                <!-- composant et logique francois à ajouter quand il aura fini -->
                <!-- favoris -->
                <x-svg.heartIcon />
                <!-- achat -->
                <x-svg.cartIcon />
            </div>

            <!-- Lien saq -->
            <a href="{{ $bouteille->url_saq }}" target="_blank" class="link">Lien vers la SAQ</a>
        </div>
    </div>

    <!-- Infos cellier -->
    <div class="detailsCellier">
        <h2>Mes réserves</h2>
        <div id='modaleContent' class="cards-container">Récupération de l'inventaire...</div>
    </div>
</section>
@endsection

