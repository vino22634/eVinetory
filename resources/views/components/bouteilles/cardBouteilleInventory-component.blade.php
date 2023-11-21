<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
.bouteilleCellier_cta {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}
</style>

<!-- Nom cellier -->
<p>{{ $bouteilleCellier->cellier->name }}</p>

@if( $bouteilleCellier->id )
    <!-- Quantité -->
    <div class="bouteilleCellier_cta">
        
        <div class="number-input  cardBouteilleCellier-quantity">
            <button onclick="decrementValue(this)"></button>
            <input class="quantity" name="quantity" type="number" min="0" value="{{ $bouteilleCellier->quantite }}" id="bouteilleCellierAmount"
                data-id="{{ $bouteilleCellier->id }}"
                onchange="bouteilleCellier_saveAmount(this, '{{ $bouteilleCellier->id }}')" />
            <button onclick="incrementValue(this)" class="plus" aria-label="Diminuer quantité"></button>
        </div>
        <img src="/img/icons/delete.svg" alt="supprimer" title="Supprimer du cellier" class="icons_action" onclick="bouteilleCellier_delete(this, '{{ $bouteilleCellier->id }}', 
                '{{ $bouteilleCellier->id_bouteille }}')">
    </div>

@else
    <button class="button-small button ajout" aria-label="augmenter quantité"
        onclick="bouteilleCellier_add(this, '{{ $bouteilleCellier->id }}', '{{ $bouteilleCellier->id_bouteille }}','{{ $bouteilleCellier->cellier->id }}', '{{ $bouteilleCellier->quantite }}')">Ajouter
        au cellier</button>
@endif
