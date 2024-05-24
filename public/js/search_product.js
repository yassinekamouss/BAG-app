// Sélection de l'élément input de recherche
const searchIcon = document.getElementById('search-icon');
const searchInput = document.getElementById('search-input');
const searchContainer = searchInput.closest('.search-container');

document.addEventListener('click', function(event) {
    // Vérifie si l'élément cliqué n'est ni l'input de recherche ni le div de suggestions
    if (!searchContainer.contains(event.target) && event.target !== searchInput && event.target !== searchIcon) {
        // Masque le div de suggestions
        document.getElementById("produits_de_suggestion").classList.add('d-none');
        searchContainer.classList.add('d-none');
    }
});

// Gestionnaire d'événement de clic sur l'input de recherche
searchIcon.addEventListener('click', function() {
    searchContainer.classList.toggle('d-none');
});

//Requete ajax pour recuperer les suggestion de produits : 
searchInput.addEventListener("keyup", function() {
    document.getElementById("produits_de_suggestion").classList.remove('d-none');
    const value = searchInput.value;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "http://127.0.0.1:8000/produits/search?name=" + value, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("produits_de_suggestion").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
});


//lors d'un hover sur la carte de produit :
document.querySelector('.hoverable').addEventListener('mouseover' , ()=>{
    document.querySelector('.hoverable .button a').classList.toggle('hidden');
});