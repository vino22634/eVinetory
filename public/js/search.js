const sort = document.getElementById('tri-component');
sort.addEventListener('change', function () {
    searchBouteilles();
});

let searchTimeoutToken;

function searchBouteilles() {
    const query = document.getElementById("searchField").value;
    const sort = document.getElementById("tri-component").value; // Get the selected sorting value
    // récupérer le nom de la page
    const pageSection = window.location.href.split('/').pop();

    // j'efface mon timer(UN SEUL TIMER A LA FOIS)
    if (searchTimeoutToken) {
        clearTimeout(searchTimeoutToken);
    }

    searchTimeoutToken = setTimeout(() => {
        document.getElementById("loading").style.display = "block";
        // Include the sort parameter in the fetch URL
        fetch(`/search/${pageSection}?query=${query}&sort=${sort}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest", //identifie la requete comme ajax
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => response.text())
            .then((html) => {
                document.getElementById("loading").style.display = "none";
                document.getElementById("bouteilles-container").innerHTML =
                    html;
                //document.getElementById('bouteilles_total').innerHTML = " résultats";
            })
            .catch((error) => {
                console.error("Erreur:", error);
                document.getElementById("loading").style.display = "none";
            });
    }, 500); // délais pour canceller
}