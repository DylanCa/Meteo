<?php include("/ressources/config.php"); 

$bddCo = new bddCo();
$services = $bddCo->getListServices();
include("./template/dashboard.php"); ?>