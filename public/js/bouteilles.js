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



function bouteilleCellierAmount_change(element, bouteilleCellierId) {
    console.log("bouteilleCellierId", element);

   // var bouteilleCellierId = this.getAttribute("data-id");
    var newAmount = element.value;
    console.log("newamount", newAmount);
    sendRequest("/bouteilleCellier/updateAmount", {
        id: bouteilleCellierId,
        amount: newAmount,
    })
        .then((data) => console.log(data))
        .catch((error) => console.error("Error:", error));
}

    function sendRequest(route, data, method = "POST") {
        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        return fetch(route, {
            method: method,
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(data),
        }).then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        });
    }

