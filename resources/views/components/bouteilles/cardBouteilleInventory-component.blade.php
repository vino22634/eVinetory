<style>
    .number-input {
        border: 1px solid #ddd;
        display: inline-flex;
    }

    .number-input input[type=number] {
        text-align: center;
        border: none;
        display: inline-block;
        vertical-align: top;
        line-height: normal;
        width: 4em;
    }

    .number-input button {
        border: none;
        background-color: #eee;
        line-height: normal;
        display: inline-block;
        width: 2em;
        text-align: center;
        font-size: 20px;
        cursor: pointer;
    }

    .number-input button.plus {
        order: 2;
    }

    .number-input input[type=number] {
        order: 1;
    }

    .number-input button:first-child {
        border-right: 1px solid #ddd;
    }

    .number-input button:last-child {
        border-left: 1px solid #ddd;
    }

</style>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<div class="cards-container">
    <!-- class commentée car trop en hauteur, inutile -->
    <div class="carrdBouteilleCellier">
        <div class="ctttardBouteilleCellier-details">
            <div id="bouteille-prix">Quantité dans le cellier: {{ $bouteilleCellier->Cellier->name }}</div>
        </div>

        <!-- Quantité -->
        <div class="cardBouteilleCellier-quantity" class="icons">
            <div class="number-input">
                <!-- <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button> -->
                <input type="number" min="1" id="bouteilleCellierAmount" data-id="{{ $bouteilleCellier->id }}"
                    onchange="bouteilleCellierAmount_change(this, '{{ $bouteilleCellier->id }}')" />
                <!-- <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button> -->
            </div>
        </div>
        <img src="/img/icons/delete.svg" alt="supprimer" class="icons">
    </div>
</div>

<!-- <script>
    console.log('cardBouteilleInventory-component.js')
    document.getElementById('bouteilleCellierAmount').addEventListener('change', bouteilleCellierAmount_change);

    function bouteilleCellierAmount_change() {
        var bouteilleCellierId = this.getAttribute('data-id');
        var newAmount = this.value;

        sendRequest('{{ route('bouteilleCellier.updateAmount') }}', {
                id: bouteilleCellierId,
                amount: newAmount
            })
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));


    }


    function sendRequest(route, data, method = 'POST') {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        return fetch(route, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            });
    }

</script> -->
