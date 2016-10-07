<?php include_once("bddCo.php");
include_once("display.php");



function comp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

function submit($submit){
   if(isset($_POST[$submit])){
     $bddCo = new bddCo;
     $bddCo->$submit(); }
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