<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Bouteilles</title>
    <link href="/css/app.css" rel="stylesheet">

</head>

<style>
    .bouteille.bouteillecontainer {
        display: flex;
        flex-direction: row;
        flex-wrap: wsrap;
        justify-content: spwace-between;
        border-radius: 10px;

        /* border : 1px solid black; */
        margin: 10px;
        padding: 10px;
        shadow: 10px 10px 5px #B8B8B8;
        backwground-color: red;
    }

    .bouteillecontainer>div:last-child {
        flex: 1;
        /* Le deuxième div prend le reste de la largeur disponible */
    }

    .bouteille .bouteillefooter {
        display: flex;
        flex-direction: row;
        flex-wrap: wsrap;
        justify-content: space-between;
    }

    .bouteilleImg {
        display: block;
        margin-left: auto;
        margin-right: auto;
        height: 104px;
    }

    .bouteilleIcon {
        display: block;
        max-width: 26px;
    }

    .icon-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
    }

    .bouteillecontainer .titre {
        font-weight: 500;
        font-size: var(--normal-font-size);
    }


    .bouteillecontainer .description {
        fownt-weight: 500;
        color: var(--color-text70);
        font-size: var(--small-font-size);
        letter-spacing: 0.25px;
    }

     .bouteillecontainer .prix {
       font-weight: 700;
       font-family: 'Lora', serif;
       fontw-size: var(--h1-font-size);
     }


</style>

<body class="container ">
    <h1>Liste des Bouteilles</h1>

    @foreach($bouteilles as $bouteille)
        <div class="bouteille bouteillecontainer" data-bouteille-id="{{ $bouteille->id }}">

            <div>
                <img class="bouteilleImg" src=" {{ $bouteille->image }}" alt="{{ $bouteille->nom }}" width="100">
            </div>
            <div width="100%">
                <div class="titre">{{ $bouteille->nom }}</div>
                <div class="description">{{ $bouteille->description }}</div>


                <div class="bouteillefooter">

                    <div class="prix">{{ $bouteille->prix_saq }} $</div>
                    <div class="icon-container">

                        <img class="bouteilleIcon toggle-icon"
                            src="{{ true ? '/img/icons/bouteilles/favON@2x.png' : '/img/icons/bouteilles/fav@2x.png' }}"
                            alt="Favorite" data-action="toggle-favorite">
                        <img class="bouteilleIcon toggle-icon"
                            src="{{ true ? '/img/icons/bouteilles/purchaseON@2x.png' : '/img/icons/bouteilles/purchase@2x.png' }}"
                            alt="Favorite" width="20" ç data-action="toggle-favorite">
                        <img class="bouteilleIcon toggle-icon"
                            src="{{ true ? '/img/icons/bouteilles/cellierON@2x.png' : '/img/icons/bouteilles/cellier@2x.png' }}"
                            alt="Favorite" width="20" data-action="toggle-favorite">





                    </div>

                </div>


            </div>
        </div>
    @endforeach


</body>

</html>




<script>
    console.log('script')

    const favoriteAndPurchaseIcons = document.querySelectorAll('[data-action="toggle-favorite"');


    favoriteAndPurchaseIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            console.log('click')
            const bouteilleId = this.closest('.bouteillecontainer').getAttribute(
                'data-bouteille-id');
            const action = this.getAttribute('data-action');



            if (this.getAttribute('src') === `${action}@2x.png`) {
                this.setAttribute('src', `${action}ON@2x.png`);
            } else {
                this.setAttribute('src', `${action}@2x.png`);
            }
        });
    });




    function toggleAction(bouteilleId, action) {
        fetch(`/${action}-toggle/${bouteilleId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    bouteilleId
                }),
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error(`La mise à jour de l'action "${action}" a échoué`);
                }
            })
            .then(data => {
                const icon = document.querySelector(`[data-bouteille-id="${bouteilleId}"] .${action}-icon`);
                if (icon) {
                    const iconPath = data.message.includes('ajoutée') ? `${action}ON@2x.png` :
                        `${action}@2x.png`;
                    icon.setAttribute('src', `/img/icons/${iconPath}`);
                }
            })
            .catch(error => {
                console.error(`Erreur lors de la requête AJAX pour l'action "${action}":`, error);
            });
    }

    document.addEventListener('toggle-favorite', function (event) {
        const bouteilleId = event.detail;
        toggleAction(bouteilleId, 'favorite');
    });

    document.addEventListener('toggle-purchase', function (event) {
        const bouteilleId = event.detail;
        toggleAction(bouteilleId, 'purchase');
    });

</script>
