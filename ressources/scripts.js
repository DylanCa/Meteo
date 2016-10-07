function alertBox(type, service){
	
	switch(type){
		case 'modify':
			window.alert('Le service ' + service + ' a bien été modifié.');
			break;

		case 'delete':
			window.alert('Le service ' + service + ' a bien été supprimé.');
			break;

		default:
			break;
	}
}

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

