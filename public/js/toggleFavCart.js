
//*********************** */
//* toggleBouteillePreferences: Modifier les préférences d'une bouteilleUser et ajuster l'état de l'icone
// * @param {*} element clicked element
// * @param {*} bouteilleId
//*  @param {*} propriété de la bouteille à modifier

function toggleBouteillePreferences (sender, bouteilleId, action) {
    sendRequest(`/bouteilles_toggle${action}/${bouteilleId}`, { bouteilleId })
        .then(data => {
            console.log( `Action "${action}" mise à jour avec succès:`, data.message)
            const currentSrc = sender.getAttribute('src');
            const baseSrc = `/img/icons/bouteilles/${action}`;
            sender.setAttribute('src', currentSrc === `${baseSrc}@2x.png` ? `${baseSrc}ON@2x.png` : `${baseSrc}@2x.png`);
        })
        .catch(error => {
            console.error( `Erreur lors de la requête AJAX pour l'action "${action}":`, error)
        })
}
