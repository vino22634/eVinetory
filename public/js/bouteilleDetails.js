//*********************** */
//* Get the inventory of Bouteilles as a view
// * @param {*} bouteilleId
//
function manageCellierForBouteilleDetail(bouteilleId) {
    console.log("manageCellierForBouteille", bouteilleId);
    fetch("/ajax/bouteilles_viewfor_managecellier/" + bouteilleId)
        .then((response) => response.text())
        .then((html) => {
            //console.log("html", html)
            document.getElementById("modaleContent").innerHTML = html;
        })
        .catch((error) => console.error("Error:", error));
}


document.addEventListener('DOMContentLoaded', (event) => {
    console.log("Bouteille Detail DOMContentLoaded");
    // récupérer le ID de la bouteille dans le DOM
        var bouteilleId =
            document.getElementById("bouteilleid").dataset.bouteilleid;
            
        manageCellierForBouteilleDetail(bouteilleId);
});
