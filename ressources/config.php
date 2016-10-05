<?php include_once("bddCo.php");
include_once("display.php");



function comp($a, $b) { 
    $c = $b[1] - $a[1];
    $c .= $b[0] - $a[0];
    return $c;
}

function submit($submit){
   if(isset($_POST[$submit])){
     $bddCo = new bddCo;
     $bddCo->$submit(); }
}
?>