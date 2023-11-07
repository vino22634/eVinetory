@extends('layouts/app')
@section('title', 'Bouteilles')
@section('content')

<link href="/css/bouteille.css" rel="stylesheet">

<style> </style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <div>
        <h2>Liste des Bouteilles</h2>
        <x-tri-component />
<div>
    <input type="text" id="searchField" placeholder="Recherche..." onkeyup="searchBouteilles()">
</div>
    </div> 
    <!-- Liste des bouteilles -->
    <div id=bouteilles-container>@include('bouteilles.partials-bouteilleslist',['bouteilles'=> $bouteilles])</div>
    
    <div id="loading" style="display: none;">Chargement ...</div>
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

    document.addEventListener('DOMContentLoaded', (event) => {
        let lastPage = {{$bouteilles->lastPage()}};
        let currentPage = 1;
        window.onscroll = function () {
            //console.log('scroll')
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                // stop a la dernière page
                if (currentPage < lastPage) {
                    currentPage++;
                    let isLoading = true;
                    loadMoreBouteilles(currentPage);
                }
            }
        }

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

                    document.getElementById('loading').style.display ='none'; 
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

    const sort = document.getElementById('tri-component');
    sort.addEventListener('change', function () {
        searchBouteilles();
    });

    let searchTimeoutToken;

    function searchBouteilles() {
        const query = document.getElementById('searchField').value;
        const sort = document.getElementById('tri-component').value; // Get the selected sorting value

        // j'efface mon timer(UN SEUL TIMER A LA FOIS)
        if (searchTimeoutToken) {
            clearTimeout(searchTimeoutToken);
        }

        searchTimeoutToken = setTimeout(() => {
            document.getElementById('loading').style.display = 'block';
            // Include the sort parameter in the fetch URL
            fetch(`/search/bouteilles?query=${query}&sort=${sort}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',  //identifie la requete comme ajax
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('loading').style.display ='none'; 
                document.getElementById('bouteilles-container').innerHTML = html;
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('loading').style.display = 'none';
            });
        }, 500); // délais pour canceller
    }

</script>

@endsection
