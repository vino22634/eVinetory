<div class="cardBouteilleCellier">

            <!-- Image -->
            <!-- si l'image source ne contient pas le mot 'http', on load cette image par défaut : /img/icons/bottle.png -->
            @if(!Str::contains($detailBouteilleCellier->image, 'http') || Str::contains($detailBouteilleCellier->image, 'pastille'))
            <img src="/img/icons/bottle.png" alt="{{ $detailBouteilleCellier->nom }}">
            @else
            <img src="{{ $detailBouteilleCellier->image }}" alt="{{ $detailBouteilleCellier->nom }}">
            @endif

            <!-- Détails -->
            <div class="cardBouteilleCellier-details">
                <div id="bouteille-nom">{{ $detailBouteilleCellier->nom }}</div>
                <div>{{ Str::before($detailBouteilleCellier->description, 'Code') }}</div>
                <div id="bouteille-prix">{{ $detailBouteilleCellier->prix_saq }} $</div>
            </div>

            <!-- Quantité -->
            <div class="cardBouteilleCellier-quantity" class="icons" >
                <span>-</span>
                <span id="bouteille-quantite">{{ $detailBouteilleCellier->pivot->quantite }}</span>
                <span>+</span>
            </div>

            <img src="/img/icons/delete.svg" alt="supprimer" title="Supprimer du cellier" class="icons_action"
                onclick="bouteilleCellier_delete(this, '{{ $detailBouteilleCellier->pivot->id }}',
                '{{ $detailBouteilleCellier->pivot->id_cellier }}')">
</div>