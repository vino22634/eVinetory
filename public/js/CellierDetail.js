//*********************** */
//* Get the inventory of Bouteilles as a view
// * @param {*} bouteilleId
//
function manageCellierForCelierDetail(bouteilleId) {
    console.log("manageCellierForBouteillebb", bouteilleId);
        console.log("manageCellierForBouteillecc", bouteilleId);

    //fetch("/ajax/bouteilles_viewfor_managecellier/" + bouteilleId)
    console.log("manageCellierForBouteille", bouteilleId, "/ajax/bouteilles_viewfor_managecellier/" + bouteilleId);
    fetch("/ajax/bouteilles_viewfor_managecellier/" + bouteilleId)
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("modaleContent").innerHTML = html;
        })
        .catch((error) => console.error("Error:", error));
}

document.addEventListener("DOMContentLoaded", (event) => {
    //console.log("CellierDetail DOMContentLoaded");
    // récupérer le ID de la bouteille dans le DOM
    var itemId = document.getElementById("cellierID").dataset.cellierid;
    console.log("CellierDetail DOMContentLoaded pour cellier: ", itemId, 333);
    manageCellierForCelierDetail(10915);
});
