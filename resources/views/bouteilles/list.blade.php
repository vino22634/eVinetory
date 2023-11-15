@extends('layouts/app')
@section('title', 'Bouteilles')
@section('content')

<script src="{{ asset('js/utils.js') }}" defer></script>
<script src="{{ asset('js/bouteilles.js') }}" defer></script>

<link href="/css/components/cardBouteilleSearch.css" rel="stylesheet">
<link href="/css/components/cardCellier.css" rel="stylesheet">
<link href="/css/components/cardBouteilleCellier.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/modale.js') }}" defer></script>
<link href="{{ asset('css/components/modale.css') }}" rel="stylesheet">

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
            padding:1rem;
        }
        
        .bouteilleSearch__tri input {
            flex:1;
            max-height: 10px;
            font-size: 16px;
            /* paddwing: 0.5rem; */
            border: 1px solid #ccc;
            border-radius: 0.5rem;
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

<!-- Modal confirmation suppression-->
<div class="modale" id="modaleSupp" tabindex="-1" aria-labelledby="ModaleSupp" aria-hidden="true">
    <section>
    
    <div class="modale-content-large">


   
    <a href="{{ route('bouteilles.list') }}" class="">← Retour</a>

    <!-- Détail cellier -->
    <div class="cellier__detail">
        <h2>Mon inventaire</h2>
            
            <p>(Gérer nombre de bouteille de ce type dans votre\vos celliers)</p>
            
            
         <!-- Retour -->
    </div>
   

       <div id='modaleContent'>Récupération de l'inventaire...</div>
       
   
        <div class="modaleCTA">
            <button class="closeButton info">Fermer</button>
        </div>
    </div>
    </section>
</div>

<script>
    const favoriteAndPurchaseIcons = document.querySelectorAll('[data-action="toggle"');
    favoriteAndPurchaseIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            console.log('click')
            const bouteilleId = this.closest('.cardBouteilleSearch').getAttribute(
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

   


    const sort = document.getElementById('tri-component');
    sort.addEventListener('change', function () {
        searchBouteilles();
    });

    let searchTimeoutToken;




    
</script>

@endsection

