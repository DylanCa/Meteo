<?php include_once("bddCo.php");
include_once("display.php"); 

session_start();
$bddCo = new bddCo();
$display = new display();

function comp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

if(isset($_REQUEST['action'])){
	if($_REQUEST['action'] == 'shiblogin'){
	    $_SESSION['user'] = "dylan.cattelan@gmail.com";
	    $bddCo->checkUser();
	} else if($_REQUEST['action'] == 'logout' && isset($_SESSION['user'])){
		unset($_SESSION['user']);
	}
}

function triArrayM($array, $on, $order=SORT_ASC){

	$new_array = array();
	$sortable_array = array();

	if (count($array) > 0) {
	    foreach ($array as $k => $v) {
	        if (is_array($v)) {
	            foreach ($v as $k2 => $v2) {
	                if ($k2 == $on) {
	                    $sortable_array[$k] = $v2;
	                }
	            }
	        } else {
	            $sortable_array[$k] = $v;
	        }
	    }

	    switch ($order) {
	        case SORT_ASC:
	            asort($sortable_array);
	            break;
	        case SORT_DESC:
	            arsort($sortable_array);
	            break;
	    }

	    foreach ($sortable_array as $k => $v) {
	        $new_array[$k] = $array[$k];
	    }
	}

	return $new_array;
}

?>
