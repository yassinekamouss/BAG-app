  // Fonction pour confirmer la suppression
document.addEventListener('DOMContentLoaded', function() {
  let deleteForms = document.querySelectorAll('.delete-form');
  
  deleteForms.forEach(function(form) {
      form.addEventListener('submit', function(event) {
          event.preventDefault(); // Empêche la soumission du formulaire par défaut
          if (confirm("Êtes-vous sûr de vouloir supprimer cet élément?")) {
              form.submit(); // Soumet le formulaire s'il est confirmé
          }
      });
  });
});

/*
    * Fonction pour la reduction de sidebar :
*/ 
let barIcon = document.getElementById('display-sidebar') ;
barIcon.addEventListener('click' , ()=>{
    //recuperer les elements de sidebare : 
    let allLi = document.querySelectorAll('.list-de-task-admin') ;
    allLi.forEach((element) => {
        element.classList.toggle('d-lg-none');
    });
    if(barIcon.classList.contains('fa-arrow-right')){
        barIcon.classList.remove('fa-arrow-right');
        barIcon.classList.add('fa-arrow-left');
    }else{
        barIcon.classList.add('fa-arrow-right');
        barIcon.classList.remove('fa-arrow-left');
    }
});