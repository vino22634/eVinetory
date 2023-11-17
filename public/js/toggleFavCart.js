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

function toggleAction(bouteilleId, action) {
    sendRequest(`/bouteilles_toggle${action}/${bouteilleId}`, { bouteilleId })
        .then((data) => {
            console.log(
                `Action "${action}" mise à jour avec succès:`,
                data.message
            );
        })
        .catch((error) => {
            console.error(
                `Erreur lors de la requête AJAX pour l'action "${action}":`,
                error
            );
        });
}