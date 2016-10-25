<?php include("./ressources/config.php"); 
    
    $bddCo->checkUser();
    
            $tmp = '';
            $lastupby = $bddCo->user;
            $website = '';
            $com = '';

            if (!empty($_REQUEST['act'])) {
                $tmp = $_REQUEST['act'];
            }

            if (!empty($_REQUEST['commod'])){
                $com = $_REQUEST['commod'];
            }

            if (!empty($_REQUEST['websitemod'])){
                $website = $_REQUEST['websitemod'];
            }

            switch($tmp){
                case 'modify':
                   
                    $bddCo->modifMit($_REQUEST['etatmod'], $com, $lastupby, $website, $_REQUEST['modservmenu']);
                    
                    header("Location: /admin_meteo.php");
                    exit();
                    break;
                    

                case 'add':
                    
                    $bddCo->addMit($_REQUEST['servadd'], $_REQUEST['gostate'], $lastupby, $website);

                    header("Location: /admin_meteo.php");
                    exit(); 
                    break;
                    

                case 'delete':

                    $bddCo->delMit($_REQUEST['servdelete'], $lastupby);

                    header("Location: /admin_meteo.php");
                    exit();
                    break;


                case 'addmin':

                    $bddCo->addmin($_REQUEST['nameadmin'], $_REQUEST['surnameadmin'], $_REQUEST['mailadmin'], $_REQUEST['superadmin']);
                    header("Location: /admin_meteo.php");
                    exit();
                    break;

                default: 
                    $services = $bddCo->getListServices();
                    include("./template/admin.php");
                    break;
        }

?>
