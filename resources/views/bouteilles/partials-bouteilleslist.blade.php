
@forelse($bouteilles as $bouteille)
    <x-bouteilles.bouteille-component :bouteille="$bouteille" />
@empty
<p>Aucune bouteille trouvée</p>
@endforelse