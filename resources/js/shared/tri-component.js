    
console.log('tri-component.js chargé!!!');   
// Trier les bouteilleCellier__card par ordre alphabétique, par quantité ou par prix
    const tri = document.querySelector('#tri');
    const bouteilleCellier__cardContainer = document.querySelector('.bouteilleCellier__card-container');
    const bouteilleCellier__card = document.querySelectorAll('.bouteilleCellier__card');

    tri.addEventListener('change', () => {
        // Trier par nom
        if (tri.value === 'nom') {
            bouteilleCellier__cardContainer.innerHTML = '';
            const bouteilleCellier__cardSorted = [...bouteilleCellier__card].sort((a, b) => {
                if (a.querySelector('#bouteille-nom').textContent < b.querySelector('#bouteille-nom').textContent) {
                    return -1;
                } else if (a.querySelector('#bouteille-nom').textContent > b.querySelector('#bouteille-nom').textContent) {
                    return 1;
                } else {
                    return 0;
                }
            });
            bouteilleCellier__cardSorted.forEach(bouteilleCellier__card => {
                bouteilleCellier__cardContainer.appendChild(bouteilleCellier__card);
            });
            // Trier par quantité
        } else if (tri.value === 'quantite') {
            bouteilleCellier__cardContainer.innerHTML = '';
            const bouteilleCellier__cardSorted = [...bouteilleCellier__card].sort((a, b) => {
                if (a.querySelector('#bouteille-quantite').textContent < b.querySelector('#bouteille-quantite').textContent) {
                    return -1;
                } else if (a.querySelector('#bouteille-quantite').textContent > b.querySelector('#bouteille-quantite').textContent) {
                    return 1;
                } else {
                    return 0;
                }
            });
            bouteilleCellier__cardSorted.forEach(bouteilleCellier__card => {
                bouteilleCellier__cardContainer.appendChild(bouteilleCellier__card);
            });
            // Trier par prix
        } else if (tri.value === 'prix') {
            bouteilleCellier__cardContainer.innerHTML = '';
            const bouteilleCellier__cardSorted = [...bouteilleCellier__card].sort((a, b) => {
                if (a.querySelector('#bouteille-prix').textContent < b.querySelector('#bouteille-prix').textContent) {
                    return -1;
                } else if (a.querySelector('#bouteille-prix').textContent > b.querySelector('#bouteille-prix').textContent) {
                    return 1;
                } else {
                    return 0;
                }
            });
            bouteilleCellier__cardSorted.forEach(bouteilleCellier__card => {
                bouteilleCellier__cardContainer.appendChild(bouteilleCellier__card);
            });
        }
    });
