<?php include("./ressources/config.php"); 


$services = $bddCo->getListServices();

if(isset($_REQUEST['action'])){
	if($_REQUEST['action'] == 'shiblogin'){
	    $_SESSION['user'] = "dylan.cattelan@gmail.com";
	    $bddCo->checkUser();
	} else if($_REQUEST['action'] == 'logout' && isset($_SESSION['user'])){
		unset($_SESSION['user']);
	}
}

include("./template/dashboard.php"); ?>
