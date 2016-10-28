<?php include("../ressources/config.php"); 
    
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
                    
                    header("Location: /admin/admin_meteo.php");
                    exit();
                    break;
                    

                case 'add':
                    
                    $bddCo->addMit($_REQUEST['servadd'], $_REQUEST['gostate'], $lastupby, $website);

                    header("Location: /admin/admin_meteo.php");
                    exit(); 
                    break;
                    

                case 'delete':

                    $bddCo->delMit($_REQUEST['servdelete'], $lastupby);

                    header("Location: /admin/admin_meteo.php");
                    exit();
                    break;


                case 'addmin':

                    $bddCo->addmin($_REQUEST['nameadmin'], $_REQUEST['surnameadmin'], $_REQUEST['mailadmin'], $_REQUEST['superadmin']);
                    header("Location: /admin/admin_meteo.php");
                    exit();
                    break;

                case 'modadmin':
                if(isset($_REQUEST['deladminMit'])){
                    $bddCo->deladmin($_REQUEST['addmin']);

                } elseif(isset($_REQUEST['addadminMit'])){
                    $bddCo->modifadmin($_REQUEST['roleadmin'], $_REQUEST['nomadmin'], $_REQUEST['prenomadmin'], $_REQUEST['delmailadmin'], $_REQUEST['addmin']); 
                } 
                    header("Location: /admin/admin_meteo.php");
                    exit();
                    break;

                default: 
                    $services = $bddCo->getListServices();
                    $admin = $bddCo->getListAdmin();
                    include("./template/admin.php");
                    break;
        }

?>
