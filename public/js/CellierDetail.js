//*********************** */
//* Récupérer inventaire de bouteilles pour un cellier (en tant que View)
// * @param {*} cellierId
//
function manageCellierForCelierDetail(cellierId) {
    fetch("/ajax/viewfor_managecellierbycellier/" + cellierId)
        .then((response) => response.text())
        .then((html) => {
             console.log(
                 "manageCellierForCelierDetail: reload cellierId: ",
                 cellierId
             );
            document.getElementById("modaleContent").innerHTML = html;
        })
        .catch((error) => console.error("Error:", error));
}

document.addEventListener("DOMContentLoaded", (event) => {
    // récupérer le ID de la bouteille dans le DOM
    var itemId = document.getElementById("cellierID").dataset.cellierid;
    manageCellierForCelierDetail(itemId);
});


//*********************** */
//* BouteilleCellier: Delete
// * @param {*} element clicked element
// * @param {*} bouteilleCellierId Id bouteilleCellier
//
function bouteilleCellier_delete(element, bouteilleCellierId, cellierID) {
    sendRequest(
        "/bouteilleCellier/delete",
        { id: bouteilleCellierId },
        "DELETE"
    )
        .then((data) => {
           
            manageCellierForCelierDetail(cellierID);
        })
        .catch((error) => console.error("Error:", error));
}
