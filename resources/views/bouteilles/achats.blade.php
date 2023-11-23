@extends('layouts/app')
@section('title', 'Achats')
@section('content')

<script src="{{ asset('js/utils.js') }}" defer></script>
<script src="{{ asset('js/bouteilles.js') }}" defer></script>
<script src="{{ asset('js/toggleFavCart.js') }}" defer></script>
<script src="{{ asset('js/modale.js') }}" defer></script>
<script src="{{ asset('js/bouteilleCellierOperations.js') }}" defer></script>

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
    <h2 id="bouteilles_total">Liste d'achats</h2>

    <!-- Recherche et tri -->
    <div class='bouteilleSearch__tri'>
        <input class='cards-container' type="search" id="searchField"
            placeholder="Recherche..." aria-label="Recherche">
        <x-tri-component />
    </div>

    <!-- Liste des bouteilles -->
    <div id=bouteilles-container class="cards-container">@include('bouteilles.partials-bouteilleslist',['bouteilles'=> $bouteilles])
    </div>
    
    <div id="loading" style="display: none;">Chargement ...
    </div>
</section> 


<!-- Modale Ajout Celliers -->
<div class="modale" id="modaleSupp" tabindex="-1" aria-label="Modale" aria-hidden="true">
    <section>
        <div class="modale-content modale-large">
            <!-- Détail cellier -->
            <h2>Mon inventaire</h2>
            <p>Consulter et ajuster le nombre de bouteilles présentes dans vos celliers.</p>
            <div id='modaleContent' class="cards-container">Récupération de l'inventaire...</div>
            <a href="{{route('cellier.create')}}" class="button info">Créer un nouveau cellier</a>
            <button class="" id="closeModale">Fermer</button>
        </div>
    </section>

</div>

<script>
    let isLoading = false;
    document.addEventListener('DOMContentLoaded', (event) => {
        let lastPage = {{$bouteilles->lastPage()}};
        let currentPage = 1;
        let searchTimeoutToken;
        function scrollLazyLoading() {
            let offsetFooter = 200;
            if (
                window.innerHeight + window.scrollY + offsetFooter >=
                    document.body.scrollHeight &&
                !isLoading
            ) {
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
        filterInput.addEventListener('click', searchClick);
        

        function loadMoreBouteilles(page) {
            //console.log("loadMoreBouteilles", page, "called");
            const query = document.getElementById("searchField").value;
            const sort = document.getElementById("tri-component").value;
            document.getElementById("loading").style.display = "block";
            fetch(`/ajax/bouteilles?page=${page}&query=${query}&sort=${sort}`, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest", // optionnel mais selon stackoverflow améliore la réactivité(car spécifie  au serveur que c'est une requête ajax)
                },
            })
            .then((response) => response.text())
            .then((html) => {
                isLoading = false;
                //console.log("loadMoreBouteilles", page, "received");

                document.getElementById("loading").style.display = "none";
                if (html.trim().length == 0) {
                    //  Plus rien à charger, on désactive le scroll infini
                    //window.removeEventListener("scroll", scrollLazyLoading);
                } else {
                    if (html.includes("Aucune bouteille trouvée")) {
                        //document.getElementById('bouteilles-container').innerHTML = html;
                    } else {
                        document
                            .getElementById("bouteilles-container")
                            .insertAdjacentHTML("beforeend", html);
                    }
                }
                if (html.includes("Aucune bouteille trouvée")) {
                    window.removeEventListener("scroll", scrollLazyLoading);
                }
            })
            .catch((error) => {
                console.error("Erreur:", error);
                isLoading = false;
                document.getElementById("loading").style.display = "none";
            });                     
        }

        function searchBouteilles() {
            window.removeEventListener("scroll", scrollLazyLoading);
            window.addEventListener("scroll", scrollLazyLoading);
            const query = document.getElementById("searchField").value;
            const sort = document.getElementById("tri-component").value; // Get the selected sorting value
            // récupérer le nom de la page
            const pageSection = window.location.href.split('/').pop();

            // j'efface mon timer(UN SEUL TIMER A LA FOIS)
            if (searchTimeoutToken) {
            clearTimeout(searchTimeoutToken);
            }

            searchTimeoutToken = setTimeout(() => {
            document.getElementById("loading").style.display = "block";
            // Include the sort parameter in the fetch URL
            fetch(`/search/${pageSection}?query=${query}&sort=${sort}`, {
                headers: {
                "X-Requested-With": "XMLHttpRequest", //identifie la requete comme ajax
                "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
                },
                })
                .then((response) => response.text())
                .then((html) => {
                    document.getElementById("loading").style.display = "none";
                    document.getElementById("bouteilles-container").innerHTML =
                    html;
                //document.getElementById('bouteilles_total').innerHTML = " résultats";
                })
                .catch((error) => {
                    console.error("Erreur:", error);
                    document.getElementById("loading").style.display = "none";
                });
            }, 500); // délais pour canceller
        }

        // gestion du click sur le x du champ de recherche
        function searchClick(event) {
            if (event.target.type === "search") {
                // Ajout d'un timeout pour que le champ soit bien vidé avant de lancer la recherche
                setTimeout(function () {
                    searchBouteilles();
                }, 0);
            }
        }

        // gestion du tri
        const sort = document.getElementById('tri-component');
        sort.addEventListener('change', function () {
            searchBouteilles();
        });
    });
</script>

@endsection
