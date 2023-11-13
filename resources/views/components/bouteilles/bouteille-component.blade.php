<div class="cardBouteilleSearch" data-bouteille-id="{{ $bouteille->id }}">

    <div class='bouteilleImg_container'>
        <img class="bouteilleImg" src=" {{ $bouteille->image }}" alt="n\a">
    </div>
    <div class='bouteilledescriptions_container' width="100%">
        <div class="titre">{{ $bouteille->nom }}</div>
        <div class="bouteilleIcons-container">
            
            @if ($bouteille->pastilleType )
                <img class="pastilleIcon" src="{{ $bouteille->pastilleType->imageURL }}"
                    alt="Pastille" 
                    title="{{ $bouteille->pastilleType->description }}"
                    >
            @endif
                
            <div class="description">
                {{ ($bouteille->type ==1) ? 'Vin rouge' : 'Vin blanc' }}, {{ $bouteille->format }},
                {{ $bouteille->pays }}
            </div>

        </div>
 
        <div class="bouteillefooter">

            <div class="prix">{{ $bouteille->prix_saq }} $</div>
            <div class="bouteilleIcons-container">

                <img class="toggle-icon icons_action"
                    src="{{ ($bouteille->userPreferences && $bouteille->userPreferences->favoris) ? '/img/icons/bouteilles/FavorisON@2x.png' : '/img/icons/bouteilles/Favoris@2x.png' }}"
                    alt="Favoris" data-action="toggle" data-action-param='Favoris'>
                    
                <img class="toggle-icon icons_action"
                    src="{{ ($bouteille->userPreferences && $bouteille->userPreferences->listeDachat) ? '/img/icons/bouteilles/PurchaseON@2x.png' : '/img/icons/bouteilles/Purchase@2x.png' }}"
                    alt="Liste d'achat"  data-action="toggle" data-action-param='Purchase'>

                <!-- récupérer le nombre d'items pour ce user (état ON si  0)-->
                @php
                    $celliersDeBouteille = $bouteille->bouteilleCelliersForUser(auth()->id());
                @endphp
                <img class="bouteilleIcon icons_action" id='modalreTrigger'
                    src="{{ count($celliersDeBouteille) > 0 ? '/img/icons/bouteilles/cellierON@2x.png' : '/img/icons/bouteilles/cellier@2x.png' }}"
                    alt="cellier" da3ta-action="toggle" data-action-param='$bouteille->id'
                    onclick="manageCellierForBouteille({{ $bouteille->id }})">
            </div>
        </div>


    </div>
</div>

