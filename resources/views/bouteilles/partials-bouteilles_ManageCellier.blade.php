<strong>Voici l'inventaire dans chacun de vos celliers:</strong>

@foreach($mesCelliers as $nomCellier => $dataCellier)
    <div>
        @forelse($dataCellier['contenu'] as $bouteilleCellier)
            <x-bouteilles.cardBouteilleInventory-component :bouteilleCellier="$bouteilleCellier" />
        @empty
            <div class="cards-container">
                <div> Pas de bouteilles dans le cellier {{ $nomCellier }}</div>
            </div>
        @endforelse

    </div>
@endforeach
