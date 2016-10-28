

function pagechange(id) {

    var form = document.getElementsByClassName('form'),
        i;


    for (var i = 0; i < form.length; i++) {
        form[i].style.visibility = 'hidden';
        form[i].style.display = 'none';
    }


    curr = document.getElementById(id);
    curr.style.visibility = 'visible';
    curr.style.display = 'block';

    switch(id){
        case 'modserv':
            document.getElementById("current").innerHTML = "Modifier un service existant";
            break;
        case 'addserv':
            document.getElementById("current").innerHTML = "Ajouter un service";
            break;

        case 'delserv':
            document.getElementById("current").innerHTML = "Désactiver un service";
            break;

        case 'addmin':
            document.getElementById("current").innerHTML = "Ajouter un administrateur";
            break;

        case 'deladmin':
            document.getElementById("current").innerHTML = "Modifier ou Supprimer un administrateur";
            break;

        default:
            document.getElementById("current").innerHTML = "Modifier un service existant";
            break;
    }
}




function lastDDM(id, value){
  var element = document.getElementById(id);

  element.value = value;

}

/* LAYOUT PURE CSS */

(function (window, document) {

    var layout   = document.getElementById('layout'),
        menu     = document.getElementById('menu'),
        menuLink = document.getElementById('menuLink');

    function toggleClass(element, className) {
        var classes = element.className.split(/\s+/),
            length = classes.length,
            i = 0;

        for(; i < length; i++) {
          if (classes[i] === className) {
            classes.splice(i, 1);
            break;
          }
        }
        // The className is not found
        if (length === classes.length) {
            classes.push(className);
        }

        element.className = classes.join(' ');
    }

    menuLink.onclick = function (e) {
        var active = 'active';

        e.preventDefault();
        toggleClass(layout, active);
        toggleClass(menu, active);
        toggleClass(menuLink, active);
    };

}(this, this.document));

$(document).ready(function () {

    // everytime the dropdown changes
    $('select[name=modservmenu]').change(function () {
        var val = parseInt($(this).val());
       $('input[name=websitemod]').val(tab[val].Website);
       $('input[name=lastupby]').val(tab[val].LastUpdatedBy);
       $('textarea[name=commod]').val(tab[val].Commentaire);
       $('select[name=etatmod]').val(tab[val].Etat);

    });

    $('select[name=addmin]').change(function () {
        var val = parseInt($(this).val());
       $('input[name=nomadmin]').val(admintab[val].Nom);
       $('input[name=prenomadmin]').val(admintab[val].Prenom);
       $('input[name=delmailadmin]').val(admintab[val].Mail);
       $('select[name=roleadmin]').val(admintab[val].Role);

});

});
