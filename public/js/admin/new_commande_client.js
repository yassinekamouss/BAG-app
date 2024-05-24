//fonction pour recuperer les nouvelles commandes :
const authId = document.getElementById('newClientsDiv').dataset.authId;
setTimeout(() => {
    window.Echo.private('newCommande.user.' + authId)
    .listen('.newCommande' , (event)=>{
        /*
          * notifier l'admin de la nouvelle commande : 
        */
        const commandeLi = document.getElementById('commandes-li');
        const valeurActuelle = commandeLi.innerText ? parseInt(commandeLi.innerText) : 0;
        commandeLi.innerText = valeurActuelle + 1;
    });
}, 200);
//fonction pour recuperer les nouvelles clients :
setTimeout(() => {
    window.Echo.private('newClient.user.' + authId)
    .listen('.newClient' , (event)=>{
        /*
          * notifier l'admin du nouveau client : 
        */
        const clientLi = document.getElementById('clients-li');
        const valeurActuelle = clientLi.innerText ? parseInt(clientLi.innerText) : 0;
        clientLi.innerText = valeurActuelle + 1;
    });
}, 200);
