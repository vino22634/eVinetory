<div class="cardBouteilleCellier">

            <!-- Image -->
            <!-- si l'image source ne contient pas le mot 'http', on load cette image par défaut : /img/icons/bottle.png -->
            @if(!Str::contains($detailBouteilleCellier->image, 'http') || Str::contains($detailBouteilleCellier->image, 'pastille'))
            <img src="/img/icons/bottle.png" alt="{{ $detailBouteilleCellier->nom }}">
            @else
            <img src="{{ $detailBouteilleCellier->image }}" alt="{{ $detailBouteilleCellier->nom }}" width='80px' height='118px'>
            @endif

            <!-- Détails -->
            <div class="cardBouteilleCellier-details">
                <div id="bouteille-nom">{{ $detailBouteilleCellier->nom }}</div>
                <div>{{ Str::before($detailBouteilleCellier->description, 'Code') }}</div>
                <div id="bouteille-prix">{{ $detailBouteilleCellier->prix_saq }} $</div>
            </div>

            <!-- Quantité -->
            <div class="cardBouteilleCellier-cta">
                <div class="number-input  cardBouteilleCellier-quantity">
                    <button onclick="decrementValue(this)" aria-label="diminuer quantité"></button>
                    <input id="bouteille-quantite" class="quantity" name="quantity" type="number" min="0" readonly
                        value="{{ $detailBouteilleCellier->pivot->quantite }}" aria-label="Quantité"
                        id="bouteilleCellierAmount" data-id="{{ $detailBouteilleCellier->pivot->id }}"
                        onchange="bouteilleCellier_saveAmount(this, '{{ $detailBouteilleCellier->pivot->id }}')" />
                    <button onclick="incrementValue(this)" class="plus" aria-label="augmenter quantité"></button>
                </div>
                <img src="/img/icons/delete.svg" alt="supprimer" title="Supprimer du cellier" class="icons_action icon_delete"
                    onclick="bouteilleCellier_delete(this, '{{ $detailBouteilleCellier->pivot->id }}',
                    '{{ $detailBouteilleCellier->pivot->id_cellier }}')">
            </div>

</div>