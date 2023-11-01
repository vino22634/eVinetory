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
                    src="{{ ($bouteille->userPreferences && $bouteille->userPreferences->favoris) ? '/img/icons/bouteilles/favON@2x.png' : '/img/icons/bouteilles/fav@2x.png' }}"
                    alt="Favorite" data-action="toggle" data-action-param='fav'>
                    
                    <!-- todo -->
                <img class="bouteilleIcon toggle-icon"
                    src="{{ true ? '/img/icons/bouteilles/purchaseON@2x.png' : '/img/icons/bouteilles/purchase@2x.png' }}"
                    alt="Favorite" width="20" ç data-action="toggle" data-action-param='purchase'>
                <img class="bouteilleIcon toggle-icon"
                    src="{{ true ? '/img/icons/bouteilles/cellierON@2x.png' : '/img/icons/bouteilles/cellier@2x.png' }}"
                    alt="Favorite" width="20" data-action="toggle" data-action-param='cellier'>
            </div>
        </div>


    </div>
</div>

