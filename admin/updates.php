<?php include("../ressources/config.php"); 

$services = $bddCo->getListServices();
$com = $bddCo->getComList();

$servID = NULL;
$histoKind = NULL;

if(!empty($_REQUEST['chooseservice'])){
	$servID = $_REQUEST['chooseservice'];
}

if(!empty($_REQUEST['choosemod'])){

$val = $_REQUEST['choosemod'];

  switch($val){
    case 1:
      $value = "Modification";
      break;

    case 2:
      $value = "Ajout";
      break;

    case 3:
      $value = "On/Off";
      break;

    default:
      $value = $val;
      break;
  }
  
	$histoKind = $value;

}
include("./template/uptmp.php");
 ?>
