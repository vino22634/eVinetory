@extends('layouts/app')
@section('title', 'Bouteilles')
@section('content')

<script src="{{ asset('js/utils.js') }}" defer></script>
<script src="{{ asset('js/bouteilles.js') }}" defer></script>
<script src="{{ asset('js/toggleFavCart.js') }}" defer></script>
<script src="{{ asset('js/search.js') }}" defer></script>
<script src="{{ asset('js/modale.js') }}" defer></script>

<link href="/css/components/cardBouteilleSearch.css" rel="stylesheet">
<link href="/css/components/cardCellier.css" rel="stylesheet">
<link href="/css/components/cardBouteilleCellier.css" rel="stylesheet">
<link href="{{ asset('css/components/modale.css') }}" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
.bouteilleSearch__tri {
    display: flex;
    justify-content: space-between; 
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.bouteilleSearch__tri .cards-container {
    width:100%;
    flex:1;
    flex-basis: 200px;
}
</style>
<section>
    <h2 id="bouteilles_total">Liste des bouteilles</h2>

    <!-- Recherche et tri -->
    <div class='bouteilleSearch__tri'>
        <input class='cards-container' type="search" id="searchField"
            placeholder="Recherche...">
        <x-tri-component />
    </div>

    <!-- Liste des bouteilles -->
    <div id=bouteilles-container class="cards-container">@include('bouteilles.partials-bouteilleslist',['bouteilles'=> $bouteilles])
    </div>
    
    <div id="loading" style="display: none;">Chargement ...
    </div>
</section> 


<!-- Modale Ajout Celliers -->
<div class="modale" id="modaleSupp" tabindex="-1" aria-labelledby="Modale" aria-hidden="true">
    <section>
        <div class="modale-content modale-large">
            <!-- Détail cellier -->
            <div>
                <h2>Mon inventaire</h2>
                <p>Consulter et ajuster le nombre de bouteilles présentes dans vos cellier:</p>
            </div>
            <div id='modaleContent' class="cards-container">Récupération de l'inventaire...</div>
            <button class="info" id="closeModale">Fermer</button>
        </div>
    </section>

</div>

<script>
    // close modale
    document.getElementById('closeModale').addEventListener('click', function () {
        document.getElementById('modaleSupp').style.display = "none";
    });

    document.addEventListener('DOMContentLoaded', (event) => {
        console.log("DOM fully loaded and parsed")
        let lastPage = {{$bouteilles->lastPage()}};

        let currentPage = 1;
        let isLoading = false;

        function scrollLazyLoading() {
            let offsetFooter=200;
            if (((window.innerHeight + window.scrollY) + offsetFooter >= document.body.scrollHeight) && !isLoading) {
                // stop a la dernière page
                if (currentPage < lastPage) {
                    currentPage++;
                    isLoading = true;
                    loadMoreBouteilles(currentPage);
                }
            }
        }

        window.addEventListener('scroll', scrollLazyLoading);

        let filterInput = document.getElementById('searchField');
        filterInput.addEventListener('keyup', searchBouteilles);

        function loadMoreBouteilles(page) {
            console.log("loadMoreBouteilles", page, "called")
            const query = document.getElementById('searchField').value;
            const sort = document.getElementById('tri-component').value; 
            document.getElementById('loading').style.display = 'block';
             fetch(`/ajax/bouteilles?page=${page}&query=${query}&sort=${sort}`, {
                headers: {
                'X-Requested-With': 'XMLHttpRequest' // optionnel mais selon stackoverflow améliore la réactivité(car spécifie  au serveur que c'est une requête ajax)
                }
             })

                .then(response => response.text())
                .then(html => {
                    isLoading = false;
                    console.log("loadMoreBouteilles", page, "received")

                    document.getElementById('loading').style.display = 'none';
                    if (html.trim().length == 0) {
                        //  Plus rien à charger, on désactive le scroll infini
                        window.removeEventListener('scroll', scrollLazyLoading)
                    } else {
                        document.getElementById('bouteilles-container').insertAdjacentHTML('beforeend',
                            html); // Ajouter le contenu à la page
                           
                        //TOdO FH:  get also number of results updated

                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    isLoading = false;
                    document.getElementById('loading').style.display = 'none';
                });
        }
    });

</script>

@endsection
