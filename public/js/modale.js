let myModal = document.getElementById('modaleSupp');
let triggerBttn = document.getElementById("modaleTrigger");
let closeButton = document.querySelector('.closeButton');

// afficher modale quand on clique sur le lien modaleTrigger
triggerBttn.addEventListener("click", function() {
    myModal.style.display = "block";
});

// fermer la modale quand on clique sur Non
closeButton.addEventListener("click", function() {
    myModal.style.display = "none";
});

// au chargement de la page la modale est à display none
window.addEventListener("load", function() {
    myModal.style.display = "none";
});