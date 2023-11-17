//*********************** */
//* Récupérer inventaire de bouteilles pour un cellier (en tant que View)
// * @param {*} cellierId
//
function manageCellierForCelierDetail(cellierId) {
    console.log("manageCellierForCelierDetail", cellierId);
    fetch("/ajax/viewfor_managecellierbycellier/" + cellierId)
        .then((response) => response.text())
        .then((html) => {
            document.getElementById("modaleContent").innerHTML = html;
        })
        .catch((error) => console.error("Error:", error));
}

document.addEventListener("DOMContentLoaded", (event) => {
    // récupérer le ID de la bouteille dans le DOM
    var itemId = document.getElementById("cellierID").dataset.cellierid;
    //console.log("CellierDetail DOMContentLoaded pour cellier: ", itemId);
    manageCellierForCelierDetail(itemId);
});


//*********************** */
//* BouteilleCellier: Delete
// * @param {*} element clicked element
// * @param {*} bouteilleCellierId Id bouteilleCellier
//
function bouteilleCellier_delete(element, bouteilleCellierId, cellierID) {
    console.log("hello", bouteilleCellierId, cellierID, 555);

    sendRequest(
        "/bouteilleCellier/delete",
        { id: bouteilleCellierId },
        "DELETE"
    )
        .then((data) => {
            console.log("reload cellierID: ", cellierID);
            manageCellierForCelierDetail(cellierID);
        })
        .catch((error) => console.error("Error:", error));
}
