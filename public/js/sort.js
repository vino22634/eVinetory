// Trier les bouteilles par ordre alphabétique, par quantité ou par prix
const tri = document.querySelector('#tri');
const cardContainer = document.querySelector('.cards-container');


tri.addEventListener('change', () => {
    const card = document.querySelectorAll(".cardBouteilleCellier");
    if (tri.value === 'nom') {
        // Trier par nom
        cardContainer.innerHTML = '';
        const cardSorted = [...card].sort((a, b) => (a.querySelector('#bouteille-nom').textContent > b.querySelector('#bouteille-nom').textContent) ? 1 : -1);
        cardSorted.forEach(card => {
            cardContainer.appendChild(card);
        });
    } else if (tri.value === 'quantite') {
        // Trier par quantité
        cardContainer.innerHTML = '';
        const cardSorted = [...card].sort((a, b) => parseFloat(a.querySelector('#bouteille-quantite').value) - parseFloat(b.querySelector('#bouteille-quantite').value));

        cardSorted.forEach(card => {
            cardContainer.appendChild(card);
        });
    } else if (tri.value === 'prix') {
        // Trier par prix
        cardContainer.innerHTML = '';
        const cardSorted = [...card].sort((a, b) => parseFloat(a.querySelector('#bouteille-prix').textContent) - parseFloat(b.querySelector('#bouteille-prix').textContent));
        cardSorted.forEach(card => {
            cardContainer.appendChild(card);
        });
    }
});