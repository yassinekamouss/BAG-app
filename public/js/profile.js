//lors d'un click sur les button de side bare :
let parametreIcon = document.getElementById('parametreIcon');
let commandesIcon = document.getElementById('commandesIcon');
let accueilIcon = document.getElementById('accueilIcon');
let acceuil_text = document.getElementById('acceuil_text') ;
let commande_container = document.getElementById('commande_container');
let parametre_container = document.getElementById('parametre_container');
let editIcon = document.getElementById('editIcon') ;

//CLICK SUR L'ICON DE PARAMETRE DE PROFILE : 
parametreIcon.addEventListener('click' , ()=>{
    //faire disparaître  les autre element :
    commande_container.classList.add('d-none');
    acceuil_text.classList.add('d-none');
    //et faire aparaître l'element de parametre : 
    parametre_container.classList.remove('d-none');
});

//CLICK SUR L'ICON DE COMMANDE  DE PROFILE : 
commandesIcon.addEventListener('click' , ()=>{
    //faire disparaître les autre element :
    parametre_container.classList.add('d-none');
    acceuil_text.classList.add('d-none');
    //et faire aparaître l'element de parametre : 
    commande_container.classList.remove('d-none');
});

//CLICK SUR L'ICON DE PARAMETRE DE PROFILE : 
accueilIcon.addEventListener('click' , ()=>{
    //faire disparaître  les autre element :
    parametre_container.classList.add('d-none');
    commande_container.classList.add('d-none');
    //et faire aparaître l'element de parametre : 
    acceuil_text.classList.remove('d-none');
});

//CLICK SUR L'ICON D'UPDATE D'INFO DE PROFILE : 

editIcon.addEventListener('click' , ()=>{
    //get the form : 
    document.getElementById('form').submit();
});

//AFFICHAGE DU DETAILS D'UNE COMMANDES: 
function showDetails(id) {
    let details = document.getElementById(id);
    details.classList.toggle('d-none');
}