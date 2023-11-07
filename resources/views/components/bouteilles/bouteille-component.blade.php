<div class="bouteille bouteillecontainer" data-bouteille-id="{{ $bouteille->id }}">

    <div class='bouteilleImg_container'>
        <img class="bouteilleImg" src=" {{ $bouteille->image }}" alt="n\a">
    </div>
    <div class='bouteilledescriptions_container' width="100%">
        <div class="titre">{{ $bouteille->nom }}</div>
        <div class="description">{{ $bouteille->description }}</div>


        <div class="bouteillefooter">

            <div class="prix">{{ $bouteille->prix_saq }} $</div>
            <div class="bouteilleIcons-container">


                <img class="bouteilleIcon toggle-icon"
                    src="{{ ($bouteille->userPreferences && $bouteille->userPreferences->favoris) ? '/img/icons/bouteilles/FavorisON@2x.png' : '/img/icons/bouteilles/Favoris@2x.png' }}"
                    alt="Favoris" data-action="toggle" data-action-param='Favoris'>
                    
                    <!-- todo -->
                <img class="bouteilleIcon toggle-icon"
                    src="{{ ($bouteille->userPreferences && $bouteille->userPreferences->listeDachat) ? '/img/icons/bouteilles/PurchaseON@2x.png' : '/img/icons/bouteilles/Purchase@2x.png' }}"
                    alt="Liste d'achat"  data-action="toggle" data-action-param='Purchase'>
                <img class="bouteilleIcon toggle-icon"
                    src="{{ true ? '/img/icons/bouteilles/cellierON@2x.png' : '/img/icons/bouteilles/cellier@2x.png' }}"
                    alt="cellier"  data-action="toggle" data-action-param='cellier'>
            </div>
        </div>


    </div>
</div>

