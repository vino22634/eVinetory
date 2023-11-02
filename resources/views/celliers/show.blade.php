@extends('layouts/app')
@section('title', 'Détail du cellier')
@section('content')

<style>
    section {
        padding: 2rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .icons {
        width: 1.5rem;
        height: 1.5rem;
    }

    .cellier__detail {
        border-radius: 10px;
        padding: 1rem;
        background-color: var(--color-light-pink);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        color: black;
    }

    .cellier__detail-cta {
        display: flex;
        flex: 1;
        gap: 1rem;
        justify-content: space-between;
    }

    .cellier__tri {
        margin-top: 1rem;
        margin-left: auto;
    }

    .bouteilleCellier__card-container {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .bouteilleCellier__card {
        padding: 1rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.5rem;
        height: 150px;
    }

    .bouteilleCellier__card div:nth-child(2) {
        flex: 1;
    }

    .bouteille {
        flex-basis: 80px;
    }

    .bouteilleCellier__card>img {
        max-height: 100%;

        display: inline;
        text-align: center;
        object-fit: contain;
    }

    .bouteilleCellier__card-details {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .bouteilleCellier__card-quantity {
        display: flex;
        gap: 1rem;
        background-color: var(--color-light-pink);
        border-radius: 10px;
        padding: 0.5rem 1rem;
        justify-content: space-between;
        align-items: center;
    }

    .bouteilleCellier__card-details div:nth-child(1),
    .bouteilleCellier__card-quantity span:nth-child(2) {
        font-weight: 600;
    }
</style>
<section>
    <h2>Mes celliers</h2>
    <!-- Retour -->
    <a href="{{route('celliers.index')}}" class="">← Retour</a>

    <!-- Détail cellier -->
    <div class="cellier__detail">
        <h2>{{ucfirst($cellier->name)}}</h2>
        @if($cellier->description)
        <p>{{ucfirst($cellier->description)}}</p>
        @endif
        @if($cellier->bouteillesCellier->count() > 0)
        <p>Nombre de bouteilles : {{$cellier->bouteillesCellier->sum('quantite')}}</p>
        @endif
        <!-- CTA -->
        <div class="cellier__detail-cta">
            <a href="" class="">Modifier le cellier</a>
            <a href="" class="">Supprimer le cellier</a>
        </div>
    </div>

    <!-- Ajouter une bouteille au cellier -->
    <a href="{{route('bouteilles.list')}}" class="button">Ajouter une bouteille</a>

    @if($cellier->bouteillesCellier->count() > 0)
    <!-- Trier les bouteilles -->
    <div class="cellier__tri">
        <label for="tri">Trier les bouteilles par : </label>
        <select name="tri" id="tri">
            <option value="nom">Nom</option>
            <option value="quantite">Quantité</option>
            <option value="prix">Prix</option>
        </select>
    </div>
    @endif

    <!-- Détail bouteilles -->
    <ul class="bouteilleCellier__card-container">
        @forelse($cellier->detailsBouteillesCellier as $detailBouteilleCellier)
        <li class="bouteilleCellier__card">

            <!-- Image -->
            <!-- if the img source doesn't contain the word 'http', then load this image : /img/icons/bottle.png -->
            @if(!Str::contains($detailBouteilleCellier->image, 'http') || Str::contains($detailBouteilleCellier->image, 'pastille'))
            <img src="/img/icons/bottle.png" alt="{{ $detailBouteilleCellier->nom }}" class="bouteille">
            @else
            <img src="{{ $detailBouteilleCellier->image }}" alt="{{ $detailBouteilleCellier->nom }}" class="bouteille">
            @endif

            <!-- Détails -->
            <div class="bouteilleCellier__card-details">
                <div id="bouteille-nom">{{ $detailBouteilleCellier->nom }}</div>
                <div>{{ Str::before($detailBouteilleCellier->description, 'Code') }}</div>
                <div id="bouteille-prix">{{ $detailBouteilleCellier->prix_saq }} $</div>
            </div>

            <!-- Quantité -->
            <img src="/img/icons/delete.svg" alt="supprimer" class="icons">
            <div class="bouteilleCellier__card-quantity">
                <span>-</span>
                <span id="bouteille-quantite">{{ $detailBouteilleCellier->pivot->quantite }}</span>
                <span>+</span>
            </div>
        </li>
        @empty
        <li>Vous n'avez pas encore de bouteilles dans ce cellier</li>
        @endforelse
    </ul>

</section>

<script>
    // Trier les bouteilleCellier__card par ordre alphabétique, par quantité ou par prix
    const tri = document.querySelector('#tri');
    const bouteilleCellier__cardContainer = document.querySelector('.bouteilleCellier__card-container');
    const bouteilleCellier__card = document.querySelectorAll('.bouteilleCellier__card');

    tri.addEventListener('change', () => {
        // Trier par nom
        if (tri.value === 'nom') {
            bouteilleCellier__cardContainer.innerHTML = '';
            const bouteilleCellier__cardSorted = [...bouteilleCellier__card].sort((a, b) => {
                if (a.querySelector('#bouteille-nom').textContent < b.querySelector('#bouteille-nom').textContent) {
                    return -1;
                } else if (a.querySelector('#bouteille-nom').textContent > b.querySelector('#bouteille-nom').textContent) {
                    return 1;
                } else {
                    return 0;
                }
            });
            bouteilleCellier__cardSorted.forEach(bouteilleCellier__card => {
                bouteilleCellier__cardContainer.appendChild(bouteilleCellier__card);
            });
            // Trier par quantité
        } else if (tri.value === 'quantite') {
            bouteilleCellier__cardContainer.innerHTML = '';
            const bouteilleCellier__cardSorted = [...bouteilleCellier__card].sort((a, b) => {
                if (a.querySelector('#bouteille-quantite').textContent < b.querySelector('#bouteille-quantite').textContent) {
                    return -1;
                } else if (a.querySelector('#bouteille-quantite').textContent > b.querySelector('#bouteille-quantite').textContent) {
                    return 1;
                } else {
                    return 0;
                }
            });
            bouteilleCellier__cardSorted.forEach(bouteilleCellier__card => {
                bouteilleCellier__cardContainer.appendChild(bouteilleCellier__card);
            });
            // Trier par prix
        } else if (tri.value === 'prix') {
            bouteilleCellier__cardContainer.innerHTML = '';
            const bouteilleCellier__cardSorted = [...bouteilleCellier__card].sort((a, b) => {
                if (a.querySelector('#bouteille-prix').textContent < b.querySelector('#bouteille-prix').textContent) {
                    return -1;
                } else if (a.querySelector('#bouteille-prix').textContent > b.querySelector('#bouteille-prix').textContent) {
                    return 1;
                } else {
                    return 0;
                }
            });
            bouteilleCellier__cardSorted.forEach(bouteilleCellier__card => {
                bouteilleCellier__cardContainer.appendChild(bouteilleCellier__card);
            });
        }
    });
</script>

@endsection