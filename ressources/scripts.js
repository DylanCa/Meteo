

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

        case 'modadmin':
            document.getElementById("current").innerHTML = "Ajouter un administrateur";
            break;

        default:
            document.getElementById("current").innerHTML = "Modifier un service existant";
            break;
    }
}

$(document).ready(function () {

    // everytime the dropdown changes
    $('select[name=modservmenu]').change(function () {
        var val = parseInt($(this).val());
       $('input[name=websitemod]').val(tab[val].Website);
       $('input[name=lastupby]').val(tab[val].LastUpdatedBy);
       $('textarea[name=commod]').val(tab[val].Commentaire);
       $("#o"+tab[val].Etat).prop("checked", true)

    });

})


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

(function (window, document) {
document.getElementById('toggle').addEventListener('click', function (e) {
    document.getElementById('tuckedMenu').classList.toggle('custom-menu-tucked');
    document.getElementById('toggle').classList.toggle('x');
});
})(this, this.document);