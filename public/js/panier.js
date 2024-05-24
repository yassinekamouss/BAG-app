//Recuperer l'input de quantite : 
document.querySelectorAll('.quantite_component').forEach(element => {
    // À l'intérieur de chaque itération, déclarer les variables locales pour cet élément spécifique
    const input = element.querySelector('.quantite_input');
    const updateBtn = element.querySelector('#update_btn');

    // Gérer l'événement focus sur l'input
    input.addEventListener('focus', () => {
        // Afficher l'élément de mise à jour
        updateBtn.classList.remove('d-none');
    });

});
