<style>
    input {
        width: 4em;
    }

    input:invalid {
        background-color: #f0f0f0;
        color: #ccc;
    }

</style>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="cards-container">
    <!-- class commentée car trop en hauteur, inutile -->
    <div class="carrdBouteilleCellier">
        <div class="ctttardBouteilleCellier-details">
            <div id="bouteille-prix">Quantité dans le cellier: {{ $bouteilleCellier->cellier->name }}</div>
        </div>


        @if( $bouteilleCellier->id )
            <!-- Quantité -->
            <div class="cardBouteilleCellier-quantity" class="icons">
                <div class="number-input">
                    <input type="number" min="0" value="{{ $bouteilleCellier->quantite }}" id="bouteilleCellierAmount"
                        data-id="{{ $bouteilleCellier->id }}"
                        onchange="bouteilleCellier_saveAmount(this, '{{ $bouteilleCellier->id }}')" />
                </div>
            </div>
            <img src="/img/icons/delete.svg" alt="supprimer" class="icons"
                onclick="bouteilleCellier_delete(this, '{{ $bouteilleCellier->id }}', 
                '{{ $bouteilleCellier->id_bouteille }}')">

        @else

            <img src="/img/icons/bouteilles/addToCellier@2x.png" alt="supprimer" class="icons_action" onclick="bouteilleCellier_add(this, '{{ $bouteilleCellier->id }}', '{{ $bouteilleCellier->id_bouteille }}',
     '{{ $bouteilleCellier->cellier->id }}', '{{ $bouteilleCellier->quantite }}')">
        @endif
    </div>
</div>
