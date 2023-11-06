@foreach($bouteilles as $bouteille)
    <x-bouteilles.bouteille-component :bouteille="$bouteille" />
@endforeach