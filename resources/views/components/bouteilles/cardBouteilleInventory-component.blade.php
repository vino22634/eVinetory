<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
.bouteilleCellier_cta {
    display: flex;
    gap: 0.5rem;
}
</style>

<!-- Nom cellier -->
<p>{{ $bouteilleCellier->cellier->name }}</p>

@if( $bouteilleCellier->id )
    <!-- Quantité -->
    <div class="bouteilleCellier_cta">
        <input type="number" min="0" value="{{ $bouteilleCellier->quantite }}" id="bouteilleCellierAmount" width="20px"
            data-id="{{ $bouteilleCellier->id }}"
            onchange="bouteilleCellier_saveAmount(this, '{{ $bouteilleCellier->id }}')" />
        <img src="/img/icons/delete.svg" alt="supprimer"
            onclick="bouteilleCellier_delete(this, '{{ $bouteilleCellier->id }}', 
            '{{ $bouteilleCellier->id_bouteille }}')">
    </div>

@else
    <img src="/img/icons/bouteilles/addToCellier@2x.png" alt="supprimer" class="icons_action" onclick="bouteilleCellier_add(this, '{{ $bouteilleCellier->id }}', '{{ $bouteilleCellier->id_bouteille }}',
'{{ $bouteilleCellier->cellier->id }}', '{{ $bouteilleCellier->quantite }}')">
@endif
