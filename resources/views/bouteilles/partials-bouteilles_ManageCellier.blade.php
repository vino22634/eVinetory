@foreach($mesCelliers as $nomCellier => $dataCellier)
    <div>
        <strong>Cellier: {{ $nomCellier }}</strong>
        <ul>
            @forelse($dataCellier['contenu'] as $bouteilleCellier)
                <li>{{ $bouteilleCellier->bouteille->nom }} - Quantité: {{ $bouteilleCellier->quantite }}</li>
            @empty
                <li>Pas de bouteilles dans ce cellier</li>
            @endforelse
        </ul>
    </div>
@endforeach
  <div class="cards-container">
 <x-bouteilles.cardBouteilleInventory-componenttest  />

 </div>

