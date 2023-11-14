let myModal = document.getElementById('modaleSupp');
let triggerBttn = document.getElementById("modaleTrigger");
let closeButton = document.querySelector('.closeButton');

console.log(myModal, 'hello');
// afficher modale quand on clique sur le lien modaleTrigger
triggerBttn.addEventListener("click", function() {
    showModale();
});

// fermer la modale quand on clique sur Non
closeButton.addEventListener("click", function() {
    hideModale();
});

// au chargement de la page la modale est à display none
window.addEventListener("load", function () {
    hideModale();
});

function showModale() {
    myModal.style.display = "block";
}

function hideModale() {
    myModal.style.display = "none";
}

