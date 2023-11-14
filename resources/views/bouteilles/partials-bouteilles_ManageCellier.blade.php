<strong>Voici l'inventaire dans chacun de vos celliers</strong>
@foreach($mesCelliers as $nomCellier => $dataCellier)
    <div>
        @forelse($dataCellier['contenu'] as $bouteilleCellier)
            <div class="cards-container">
                <!-- class commentée car trop en hauteur, inutile -->
                <div class="carrdBouteilleCellier">
                    <div class="ctttardBouteilleCellier-details">
                        <div id="bouteille-prix"> Quantité dans le cellier {{ $nomCellier }}</div>
                    </div>

                    <!-- Quantité -->
                    <div class="cardBouteilleCellier-quantity" class="icons">
                        <span>-</span>
                        <span id="bouteille-quantite">{{ $bouteilleCellier->quantite }}</span>
                        <span>+</span>
                    </div>
                    <img src="/img/icons/delete.svg" alt="supprimer" class="icons">
                </div>
            </div>
        @empty
            <div class="cards-container">
                <div> Pas de bouteilles dans le cellier {{ $nomCellier }}</div>
            </div>
        @endforelse

    </div>
@endforeach
