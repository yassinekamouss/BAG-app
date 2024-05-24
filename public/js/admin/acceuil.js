/*
    *charts js :
*/
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('barChart');
    const commandesEnLigneParJour = JSON.parse(ctx.dataset.commandesEnLigne);
    const commandesALaLivraisonParJour = JSON.parse(ctx.dataset.commandesALaLivraison);
   
    const labels = commandesEnLigneParJour.map(item => item.year + '-' + item.month + '-' + item.day);
    const enLigneData = commandesEnLigneParJour.map(item => item.total); 
    const aLaLivraisonData = commandesALaLivraisonParJour.map(item => item.total); 

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Commandes avec paiement en ligne',
                    data: enLigneData,
                    borderWidth: 2,
                    borderColor: '#f58d8d',
                    backgroundColor: '#f58d8d',
                } , 
                {
                    label: 'Commandes avec paiement a la livraison',
                    data: aLaLivraisonData,
                    borderWidth: 2,
                    borderColor: '#008cff',
                    backgroundColor: '#008cff',
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 40
                }
            }
        }
    });
});

/*
    *websockets (pour les nouvelles commandes) : 
*/

//formatage de la date de creation  : 
function formatDate(date) {
    const options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false // Pour utiliser le format 24 heures
    };

    return new Date(date).toLocaleString('en-US', options);
}
//fonction pour recuperer les nouvelles commandes :
setTimeout(() => {
    window.Echo.private('newCommande.user.' + authId)
    .listen('.newCommande' , (event)=>{
        const nouvelleCommande = event.commande;
        const client = event.client;

        /*
          * notifier l'admin de la nouvelle commande : 
        */
        const nouvelleLigne = document.createElement('tr');
        nouvelleLigne.innerHTML = `
            <td class="d-flex align-items-center"><i class="fa-solid fa-circle-info text-danger me-2"></i>${client.nom + ' ' + client.prenom}</td>
            <td>${formatDate(nouvelleCommande.created_at)}</td>
            <td class="text-secondary fw-bold">${nouvelleCommande.etat}</td>
            <td><a href="/commandes/${nouvelleCommande.id}/edit" class="text-secondary text-decoration-none"><i class="fa-solid me-2 fa-pen"></i>Voir</a></td>`;

        // Ajouter la nouvelle ligne au tableau existant
        const tableauCommandes = document.querySelector('#tableau-commandes');
        // Obtenir la première ligne du tableau
        const premiereLigne = tableauCommandes.firstChild;

        // Insérer la nouvelle ligne avant la première ligne du tableau
        tableauCommandes.insertBefore(nouvelleLigne, premiereLigne);
        notification.appendChild()
    });
}, 200);

//fonction pour recuperer les nouvelles clients :
setTimeout(() => {
    window.Echo.private('newClient.user.' + authId)
    .listen('.newClient' , (event)=>{
        const nouvelleClient = event.client ;

        const nouvelleLigne = document.createElement('tr');
        nouvelleLigne.innerHTML = `
            <td class="d-flex align-items-center">
                <i class="fs-2 fa-solid fa-circle-user text-secondary me-2"></i>
                <i class="fa-solid fa-circle-info text-danger me-2"></i>
                <span>${nouvelleClient.prenom + ' ' + nouvelleClient.nom}</span>
            </td>
            <td>${formatDate(nouvelleClient.created_at)}</td>`;

        // Ajouter la nouvelle ligne au tableau existant
        const tableauClients = document.querySelector('#tableau-clients');
        // Obtenir la première ligne du tableau
        const premiereLigne = tableauClients.firstChild;

        // Insérer la nouvelle ligne avant la première ligne du tableau
        tableauClients.insertBefore(nouvelleLigne, premiereLigne);
    });
} , 200);
