<?php class display{

    function printServices($servicesList){

            $images = array ("néant", "1-soleil", "2-couvert", "3-orage");
            $texte_alt = ["néant", "nominal", "perturbations", "indisponible"];
            $couleur_etat = ["néant","rgba(100,250,100,0.5)","rgba(250,150,0,0.5)","rgba(250,0,0,0.5)"]; 

            $brequest = 3;

            foreach($servicesList as $data){
                if($data['Actif'] == 1){
                    $arrstate[] = array($data['Service'], $data['Etat'], $data['Commentaire'], $data['LastUpdated'], $data['Website']);
                }
            }

            foreach ($arrstate as $key => $row){
                $return_state[$key] = $row[1];
                $return_name[$key] = $row[0];
            }

            array_multisort($return_state, SORT_DESC, $return_name, SORT_ASC, SORT_NATURAL, $arrstate);
           

            foreach($arrstate as $sun){
                for($x=3 ; $x>0 ; $x--){
                    if($sun[1] == $x){

                        if($brequest != $x){
                            $brequest = $x;
                            echo "</ul><ul class:\"meteo".$sun[1]."\">";
                        }
                        echo "<a href=\"".$sun[4]."\"><li style=\"background: url(images/".$images[$x]."b.jpg); background-repeat: no-repeat; background-position: center; text-align: center\"><strong style=\"color:white; text-shadow: 2px 2px 8px #000000\"><h3>". $sun[0]."</h3></strong></li></a>";
                    }
                }
            }
            echo "</ul>";
        }

    function printCom($comList, $servID, $histoKind){

        $images = array ("néant", "1-soleil", "2-couvert", "3-orage");

        if($comList != 0){
                foreach($comList as $com){
                if(($com['ID'] == $servID || $servID == NULL) && ($com['ChangeType'] == $histoKind || $histoKind == NULL)){
                    if($com['Etat'] != 0 && $com['Actif'] == 1){
                        echo "<li><img src=\"images/" . $images[$com['Etat']] . ".svg\" title=\"" . $com['Service'] . "\" alt=\"" .$com['Service']. "\" height=\"20px\" style=\"vertical-align:middle\"> - <strong>".$com['Service']."</strong> - <i>Last Update : ".$com['LastUpdated']." by ".$com['LastUpdatedBy']."</i> - Type : <strong>".$com['ChangeType']."</strong><ul>";
                        if(!empty($com['Commentaire'])){
                            echo "<li><strong><i>Ajout d'un commentaire </i></strong>: ( ".$com['Commentaire']." )</li><p/>";
                        }
                        if(!empty($com['Website'])){
                            echo "<li><i><a href=\"".$com['Website']."\">Ajout d'un site Web ( ".$com['Website'].")</a></i></ul></li><p/>";
                        } else {
                            echo "</ul><p/>";
                        }
                    } else {
                        if($com['Actif'] == 0){
                            echo "<li style='color:red'><strong >".$com['Service']."</strong> - <i>Last Update : ".$com['LastUpdated']."</i> - Update Type : <strong>Desactivation</strong><ul>";

                           if(!empty($com['Commentaire'])){
                            echo "<li> ".$com['Commentaire']."</li><p/>";
                            }
                            if(!empty($com['Website'])){
                                echo "<li> ".$com['Website']."</ul></li><p/>";
                            } else {
                                echo "</ul><p/>";
                            }
                        } else {
                            echo "<li style='color:green'><strong >".$com['Service']."</strong> - <i>Last Update : ".$com['LastUpdated']."</i> - Update Type : <strong>Activation</strong><ul>";

                            if(!empty($com['Commentaire'])){
                            echo "<li> ".$com['Commentaire']."</li><p/>";
                            }
                            if(!empty($com['Website'])){
                                echo "<li> ".$com['Website']."</ul></li><p/>";
                            } else {
                                echo "</ul><p/>";
                            }
                        }
                    }
                }
            }
        } else { echo "<strong>Il n'y a pas eu de modification."; }

    }
}

    function refresh($servID){
        $id = $servID;

    }
?>

 
