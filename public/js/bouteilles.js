//*********************** */
//* Get the inventory of Bouteilles as a view
// * @param {*} bouteilleId
//
function manageCellierForBouteille(bouteilleId) {
    console.log("manageCellierForBouteille", bouteilleId);
    fetch("/ajax/bouteilles_viewfor_managecellier/" + bouteilleId)
        .then((response) => response.text())
        .then((html) => {
            //console.log("html", html)
            document.getElementById("modaleContent").innerHTML = html;
        })
        .catch((error) => console.error("Error:", error));

    showModale();
}

//*********************** */
//* BouteilleCellier: Save amount
// * @param {*} element clicked element
// * @param {*} bouteilleCellierId Id bouteilleCellier
//
function bouteilleCellier_saveAmount(element, bouteilleCellierId) {
    var newAmount = element.value;
    console.log("bouteilleCellier_saveAmount", element, bouteilleCellierId, newAmount);
    sendRequest("/bouteilleCellier/saveAmount", {
        id: bouteilleCellierId,
        amount: newAmount,
    })
        .then((data) => console.log(data))
        .catch((error) => console.error("Error:", error));
}

//*********************** */
//* BouteilleCellier: Delete
// * @param {*} element clicked element
// * @param {*} bouteilleCellierId Id bouteilleCellier
//
function bouteilleCellier_delete(element, bouteilleCellierId) {
    if (confirm("ëtes vous certain de vouloir effacer cet inventaire?")) {
        sendRequest(
            "/bouteilleCellier/delete",
            { id: bouteilleCellierId },
            "DELETE"
        )
            .then((data) => {
                console.log(data);
            })
            .catch((error) => console.error("Error:", error));
    }
}


//*********************** */
//* BouteilleCellier: Add
// * @param {*} element clicked element
// * @param {*} bouteilleCellierId Id bouteilleCellier
// * @param {*} idBouteille Id bouteille
// * @param {*} idCellier Id cellier
//


     

function bouteilleCellier_add(element, bouteilleCellierId, idBouteille, idCellier, quantite) {
    if (confirm("Voulez-vous ajouter cette bouteille au cellier?")) {
        sendRequest(
            "/bouteilleCellier/add", // Assurez-vous que cette route est correctement définie dans votre application Laravel
            {
                id: bouteilleCellierId, // L'identifiant de l'association BouteilleCellier, si nécessaire
                idBouteille: idBouteille, // L'identifiant de la bouteille
                idCellier: idCellier, // L'identifiant du cellier
                quantite: quantite, // L'identifiant du cellier
            },
            "POST" // Utilisez la méthode HTTP appropriée selon votre route Laravel
        )
            .then((data) => {
                console.log(data);
                // Vous pouvez mettre à jour l'interface utilisateur ici en fonction de la réponse
            })
            .catch((error) => console.error("Erreur:", error));
    }
}





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


