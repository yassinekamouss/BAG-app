// Identifier s'il la form doit-elle etre envoyer a la  route de panier ou bien l'achat:    
document.querySelector('.acheter-ajouter-form')
    .addEventListener('submit', function(event) {
        event.preventDefault();
        
        let action = event.submitter.value;
        if (action === 'ajouter_panier') {
            this.action = "/paniers/store";
        } else if (action === 'acheter_maintenant') {
            this.method = "GET" ;
            this.action = "/paiement/checkout";
        }
        this.submit();
    });
// Fin d'identification.  


// oninput="this.value = Math.max(1, this.value)"

document.querySelector('#quantite').addEventListener('input' , function(){
    this.value = Math.max(1 , this.value) ;
});