<?php include("./ressources/config.php");

    $bddCo = new bddCo();
    $tmp = '';
    $lastupby = '';
    $website = '';
    $com = '';

    if (!empty($_REQUEST['act'])) {
        $tmp = $_REQUEST['act'];
    }
    
    if (!empty($_REQUEST['lastupby'])){
        $lastupby = $_REQUEST['lastupby'];
    }

    if (!empty($_REQUEST['com'])){
        $com = $_REQUEST['com'];
    }

    if (!empty($_REQUEST['website'])){
        $website = $_REQUEST['website'];
    }

    switch($tmp){
        case 'modify':
           
            $bddCo->modifMit($_REQUEST['etatmod'], $com, $lastupby, $website, $_REQUEST['modserv']);

            header("Location: /admin_meteo.php");
            exit();
            break;
            

        case 'add':
            
            $bddCo->addMit($_REQUEST['servadd'], $_REQUEST['gostate'], $website, $lastupby);

            header("Location: /admin_meteo.php");
            exit(); 
            break;
            

        case 'delete':

            $bddCo->delMit($_REQUEST['servdelete'], $lastupby);

            header("Location: /admin_meteo.php");
            exit();
            break;


        default: 
            $services = $bddCo->getListServices();
            include("./template/admin.php");
            break;
    }
?>