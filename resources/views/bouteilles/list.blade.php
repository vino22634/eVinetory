@extends('layouts/app')
@section('title', 'Bouteilles')
@section('content')

<link href="/css/bouteille.css" rel="stylesheet">

<style>


</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">

    <div>
        <h3>Liste des Bouteilles</h3> 
    </div>
    <!-- Liste des bouteilles -->
    @foreach($bouteilles as $bouteille)
        <x-bouteilles.bouteille-component :bouteille="$bouteille" />
    @endforeach
</div>



<script>
    const favoriteAndPurchaseIcons = document.querySelectorAll('[data-action="toggle"');
    favoriteAndPurchaseIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            console.log('click')
            const bouteilleId = this.closest('.bouteillecontainer').getAttribute(
                'data-bouteille-id');
            const action = this.getAttribute('data-action-param');
            toggleAction(bouteilleId, 'favorite');
            if (this.getAttribute('src') === `/img/icons/bouteilles/${action}@2x.png`) {
                this.setAttribute('src', `/img/icons/bouteilles/${action}ON@2x.png`);
            } else {
                this.setAttribute('src', `/img/icons/bouteilles/${action}@2x.png`);
            }
        });
    });


    function toggleAction(bouteilleId, action) {
        console.log('toggleAction', bouteilleId)

        fetch(`/bouteilles_toggleFavorite/${bouteilleId}`, {
                // fetch(`/${action}-toggle/${bouteilleId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    bouteilleId
                }),
            })
            .then(response => {
                console.log("response", response)
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error(`La mise à jour de l'action "${action}" a échoué`);
                }
            })
            .then(data => {
                const icon = document.querySelector(`[data-bouteille-id="${bouteilleId}"] .${action}-icon`);
                if (icon) {
                    const iconPath = data.message.includes('ajoutée') ? `${action}ON@2x.png` :
                        `${action}@2x.png`;
                    icon.setAttribute('src', `/img/icons/${iconPath}`);
                }
            })
            .catch(error => {
                console.error(`Erreur lors de la requête AJAX pour l'action "${action}":`, error);
            });
    }

</script>

@endsection
