// Inicialization
$(document).ready(function(){
   // Déclancheur du sidenav
    $('.sidenav').sidenav();

    $('.materialboxed').materialbox();
   //Déclancheur du select dans le formulaire
    $('select').formSelect();
   // Déclancheur du compteur des caracteres dans les inputs
    $('input#codePostal, textarea#textarea1').characterCounter();

    // Date picker
    /*
      $('.datepicker').datepicker({
         firstDay: true, 
            format: 'dd-mm-yyyy', 
            i18n: {
                months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                monthsShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec"],
                weekdays: ["Dimanche","Luundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                weekdaysShort: ["Dim","Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
                weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"],
                cancel: 'Annuler',
                firstDay: 1,
                today: "Aujourd\'hui"
            }
      });
      */
      
      
  });
