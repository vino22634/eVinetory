


//*********************** */
//* Get the inventory of Bouteilles as a view
// * @param {*} bouteilleId
//
function manageCellierForBouteille(bouteilleId) {
    fetch("/ajax/bouteilles_viewfor_managecellier/" + bouteilleId)
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("modaleContent").innerHTML = html;
        })
        .catch((error) => console.error("Error:", error));

    showModale();
}

//*********************** */
//* BouteilleCellier: Delete
// * @param {*} element clicked element
// * @param {*} bouteilleCellierId Id bouteilleCellier
//
function bouteilleCellier_delete(element, bouteilleCellierId, bouteilleId) {
    sendRequest(
        "/bouteilleCellier/delete",
        { id: bouteilleCellierId },
        "DELETE"
    )
        .then((data) => {
            console.log(data);
            manageCellierForBouteille(bouteilleId);
        })
        .catch((error) => console.error("Error:", error));
}

//*********************** */
//* BouteilleCellier: Add
// * @param {*} element clicked element
// * @param {*} bouteilleCellierId Id bouteilleCellier
// * @param {*} idBouteille Id bouteille
// * @param {*} idCellier Id cellier
//

function bouteilleCellier_add(
    element,
    bouteilleCellierId,
    idBouteille,
    idCellier,
    quantite
) {
    sendRequest(
        "/bouteilleCellier/add",
        {
            id: bouteilleCellierId,
            idBouteille: idBouteille,
            idCellier: idCellier,
            quantite: quantite,
        },
        "POST" // Utilisez la méthode HTTP appropriée selon votre route Laravel
    )
        .then((data) => {
            console.log(data);
            manageCellierForBouteille(idBouteille);
        })
        .catch((error) => console.error("Erreur:", error));
}





function searchClick(event) {
    if (event.target.type === "search") {
        // Ajout d'un timeout pour que le champ soit bien vidé avant de lancer la recherche
        setTimeout(function () {
            searchBouteilles();
        }, 0);
    }
}
