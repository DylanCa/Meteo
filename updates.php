<?php include("/ressources/config.php"); 

$bddCo = new bddCo();
$services = $bddCo->getListServices();
$com = $bddCo->getComList();

$servID = NULL;

if(!empty($_REQUEST['chooseservice'])){
	$servID = $_REQUEST['chooseservice'];
}

include("./template/uptmp.php");
 ?>