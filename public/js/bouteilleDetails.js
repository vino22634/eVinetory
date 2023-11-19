//*********************** */
//* Get the inventory of Bouteilles as a view
// * @param {*} bouteilleId
//
function manageCellierForBouteilleDetail(bouteilleId) {
    fetch("/ajax/bouteilles_viewfor_managecellier/" + bouteilleId)
        .then((response) => response.text())
        .then((html) => {
            console.log("manageCellierForBouteilleDetail. Reload", bouteilleId);
            document.getElementById("modaleContent").innerHTML = html;
        })
        .catch((error) => console.error("Error:", error));
}


document.addEventListener('DOMContentLoaded', (event) => {
    // récupérer le ID de la bouteille dans le DOM
        var bouteilleId =
            document.getElementById("idbouteille").dataset.bouteilleid;
            
        manageCellierForBouteilleDetail(bouteilleId);
});
