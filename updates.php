<?php include("/ressources/config.php"); 

$bddCo = new bddCo();
$services = $bddCo->getListServices();
$com = $bddCo->getComList();

$servID = NULL;
$histoKind = NULL;

if(!empty($_REQUEST['chooseservice'])){
	$servID = $_REQUEST['chooseservice'];
}

if(!empty($_REQUEST['choosemod'])){
	$histoKind = $_REQUEST['choosemod'];
	print_r($histoKind);
}

include("./template/uptmp.php");
 ?>