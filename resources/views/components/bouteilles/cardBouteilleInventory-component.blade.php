<style>
    .number-input {
        border: 1px solid #ddd;
        display: inline-flex;
    }

    .number-input input[type=number] {
        text-align: center;
        border: none;
        display: inline-block;
        vertical-align: top;
        line-height: normal;
        width: 4em;
    }

    .number-input button {
        border: none;
        background-color: #eee;
        line-height: normal;
        display: inline-block;
        width: 2em;
        text-align: center;
        font-size: 20px;
        cursor: pointer;
    }

    .number-input button.plus {
        order: 2;
    }

    .number-input input[type=number] {
        order: 1;
    }

    .number-input button:first-child {
        border-right: 1px solid #ddd;
    }

    .number-input button:last-child {
        border-left: 1px solid #ddd;
    }

</style>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="cards-container">
    <!-- class commentée car trop en hauteur, inutile -->
    <div class="carrdBouteilleCellier">
        <div class="ctttardBouteilleCellier-details">
            <div id="bouteille-prix">Quantité dans le cellier: {{ $bouteilleCellier->Cellier->name }}</div>
        </div>

        <!-- Quantité -->
        <div class="cardBouteilleCellier-quantity" class="icons">
            <div class="number-input">
                <!-- <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button> -->
                <input type="number" min="1" value="{{ $bouteilleCellier->quantite }}" id="bouteilleCellierAmount"
                    data-id="{{ $bouteilleCellier->id }}"
                    onchange="bouteilleCellier_saveAmount(this, '{{ $bouteilleCellier->id }}')" />
                <!-- <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button> -->
            </div>
        </div>
        <img src="/img/icons/delete.svg" alt="supprimer" class="icons"
            onclick="bouteilleCellier_delete(this, '{{ $bouteilleCellier->id }}')">
    </div>
</div>

