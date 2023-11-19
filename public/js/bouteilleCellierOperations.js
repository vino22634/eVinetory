//*********************** */
//* BouteilleCellier: Change amount and trigger save function
//
function decrementValue(button) {
    var input = button.parentNode.querySelector("input[type=number]");
    input.stepDown();
    triggerSaveAmount(input);
}

function incrementValue(button) {
    var input = button.parentNode.querySelector("input[type=number]");
    input.stepUp();
    triggerSaveAmount(input);
}

function triggerSaveAmount(input) {
    var bottleId = input.getAttribute("data-id");
    bouteilleCellier_saveAmount(input, bottleId);
}


//*********************** */
//* BouteilleCellier: Save amount
// * @param {*} element clicked element
// * @param {*} bouteilleCellierId Id bouteilleCellier
//
function bouteilleCellier_saveAmount(element, bouteilleCellierId) {
    var newAmount = element.value;
    sendRequest("/bouteilleCellier/saveAmount", {
        id: bouteilleCellierId,
        amount: newAmount,
    })
        .then((data) => console.log(data))
        .catch((error) => console.error("Error:", error));
}
