<div class="cardBouteilleSearch" data-bouteille-id="{{ $bouteille->id }}">

    <div class='bouteilleImg_container'>
        <img class="bouteilleImg" src=" {{ $bouteille->image }}" alt="n\a" width='64px' height='96px'>
    </div>
    <div class='bouteilledescriptions_container' width="100%">
        <a href=" {{ route('bouteilles.show', $bouteille->id) }} " class="titre">{{ $bouteille->nom }}</a>
        <div class="bouteilleIcons-container">

            @if($bouteille->pastilleType )
                <img class="pastilleIcon" src="{{ $bouteille->pastilleType->imageURL }}" alt="Pastille"
                    title="{{ $bouteille->pastilleType->description }}" width='16px' height='16px'>
            @endif

            <div class="description">
                {{ ($bouteille->type ==1) ? 'Vin rouge' : 'Vin blanc' }},
                {{ $bouteille->format }},
                {{ $bouteille->pays }}
            </div>
        </div>

        <div class="bouteillefooter">
            <div class="prix">{{ $bouteille->prix_saq }} $</div>
            <div class="bouteilleIcons-container">

                <img class="toggle-icon icons_action"
                    src="{{ ($bouteille->userPreferences && $bouteille->userPreferences->favoris) ? '/img/icons/bouteilles/FavorisON@2x.png' : '/img/icons/bouteilles/Favoris@2x.png' }}"
                    alt="Favoris" onclick="toggleBouteillePreferences(this, {{ $bouteille->id }}, 'Favoris')">

                <img class="toggle-icon icons_action"
                    src="{{ ($bouteille->userPreferences && $bouteille->userPreferences->listeDachat) ? '/img/icons/bouteilles/PurchaseON@2x.png' : '/img/icons/bouteilles/Purchase@2x.png' }}"
                    alt="Liste d'achat" 
                    onclick="toggleBouteillePreferences(this, {{ $bouteille->id }}, 'Purchase')">

                <!-- récupérer le nombre d'items pour ce user (état ON si  0)-->
                @php
                    $celliersDeBouteille = $bouteille->bouteilleCelliersForUser(auth()->id());
                @endphp
                <img class="bouteilleIcon icons_action" id='modalreTrigger'
                    src="{{ count($celliersDeBouteille) > 0 ? '/img/icons/bouteilles/cellierON@2x.png' : '/img/icons/bouteilles/cellier@2x.png' }}"
                    alt="cellier"  data-action-param='$bouteille->id'
                    onclick="manageCellierForBouteille({{ $bouteille->id }})">
            </div>
        </div>
    </div>
</div>
