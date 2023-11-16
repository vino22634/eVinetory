@foreach($mesCelliers as $nomCellier => $dataCellier)
    <div>
        @forelse($dataCellier['contenu'] as $bouteilleCellier)
            <x-bouteilles.cardBouteilleInventory-component :bouteilleCellier="$bouteilleCellier" />
        @empty
            <p> Pas de bouteilles dans le cellier {{ $nomCellier }}</p>
        @endforelse
    </div>
@endforeach

