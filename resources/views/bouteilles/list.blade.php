@extends('layouts/app')
@section('title', 'Bouteilles')
@section('content')

<link href="/css/bouteille.css" rel="stylesheet">

<style> </style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div>
        <h3>Liste des Bouteilles</h3>
        <x-tri-component /> 

    </div> 
    @include('partials.bouteilles',['bouteilles'=> $bouteilles])

    <div id="infinite-scroll-end">
        {{-- $bouteilles->links() --}}
    </div>
</div> <!-- Liste des bouteilles -->


@foreach($bouteilles as $bouteille)
        <xw-bouteilles.bouteille-component :bouteille="$bouteille" />
@endforeach




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

    document.addEventListener('DOMContentLoaded', (event) => {
    window.onscroll = function() {
    console.log('scroll')
    // Check if we've scrolled to the bottom of the page
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
    // Check if we have more pages to load
    if (currentPage < lastPage) { currentPage++; loadMoreBouteilles(currentPage); } } }



function loadMoreBouteilles(page) {
fetch(`/ajax/bouteilles?page=${page}`)
.then(response => response.text())
.then(html => {
isLoading = false;
document.getElementById('loading').style.display =
'none'; // Cacher le spinner ou message de chargement
if (html.trim().length == 0) {
window.onscroll = null; // Plus rien à charger, on désactive le scroll infini
} else {
document.getElementById('bouteilles-container').insertAdjacentHTML('beforeend',
html); // Ajouter le contenu à la page
}
})
.catch(error => {
console.error('Erreur:', error);
isLoading = false;
document.getElementById('loading').style.display = 'none';
});
}


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

    let lastPage = {{ $bouteilles->lastPage() }}; 
    let currentPage = 1; 
                console.log('scrollw')

       


        
    </script>



@endsection
