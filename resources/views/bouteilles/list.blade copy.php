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
                <x-tri-component  />

    </div>
    <!-- Liste des bouteilles -->

     <!-- @include('partials.bouteilles', ['bouteilles' => $bouteilles]) -->
    @foreach($bouteilles as $bouteille)
        <x-bouteilles.bouteille-component :bouteille="$bouteille" />
    @endforeach
    <div id="loading" style="display: none;">
        <p>Chargement des autres bouteilles...</p>
        <!-- Vous pouvez ajouter une image de chargement si vous le souhaitez -->
    </div>
</div>



<script>
    const favoriteAndPurchaseIcons = document.querySelectorAll('[data-action="toggle"');
    favoriteAndPurchaseIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            console.log('click')
            const bouteilleId = this.closest('.bouteillecontainer').getAttribute(
                'data-bouteille-id');
           
            const action = this.getAttribute('data-action-param');
            toggleAction(bouteilleId, action);
            if (this.getAttribute('src') === `/img/icons/bouteilles/${action}@2x.png`) {
                this.setAttribute('src', `/img/icons/bouteilles/${action}ON@2x.png`);
            } else {
                this.setAttribute('src', `/img/icons/bouteilles/${action}@2x.png`);
            }
        });
    });


    function toggleAction(bouteilleId, action) {
        fetch(`/bouteilles_toggle${action}/${bouteilleId}`, {
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
                console.log("response", this)
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error(`La mise à jour de l'action "${action}" a échoué`);
                }
            })
            .then(data => {
                //considérer un reset icon en vas d'erreur (data.message.includes('ajoutée'))
                console.log(`Action "${action}" mise à jour avec succès:`, data.message);
            })
            .catch(error => {
                console.error(`Erreur lors de la requête AJAX pour l'action "${action}":`, error);
            });
    }

</script>

@endsection
