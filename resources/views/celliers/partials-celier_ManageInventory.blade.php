
    @forelse($cellier->detailsBouteillesCellier as $detailBouteilleCellier)
        <x-celliers.cardBouteilleCellier-component :detailBouteilleCellier="$detailBouteilleCellier" />
    @empty
        <li>Vous n'avez pas encore de bouteilles dans ce cellier</li>
    @endforelse


