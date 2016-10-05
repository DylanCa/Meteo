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

function ($){
	$.fn.changeSite = function(){
		$.ajax({
			url: "bddCo.php&f=getWebsite",
			type: "GET"
			success: function(website){
				$("#website").val(website);
			}
		});
	}
} 