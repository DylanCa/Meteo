 <?php class display{

    function printServices($servicesList){
            $images = array ("néant", "1-soleil", "2-couvert", "3-orage");
            $texte_alt = ["néant", "nominal", "perturbations", "indisponible"];
            $couleur_etat = ["néant","rgba(100,250,100,0.5)","rgba(250,150,0,0.5)","rgba(250,0,0,0.5)"]; 

            $brequest = 4;

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
                            echo "</ul><ul class:\"meteo\">";
                        }


                        $affichage="&nbsp;&nbsp;<img src=\"images/" . $images[$x] . ".svg\" title=\"" . $texte_alt[$x] . "\" alt=\"" .$texte_alt[$x]. "\" height=\"40px\" style=\"vertical-align:middle\"";
                        $comment="<br /><br />".$sun[2]."<br /><br/>Last Updated : ".$sun[3]."<br /><br /></li></a>";

                        echo "<a href=\"".$sun[4]."\"><li style=\"background-color: " . $couleur_etat[$x] . "\"><strong>". $sun[0] ."</strong>". $affichage. $comment;
                    }
                }
            }
        }
    function printCom($comList, $servID){

        $images = array ("néant", "1-soleil", "2-couvert", "3-orage");

        foreach($comList as $com){
            if($com['ID'] == $servID || $servID == NULL){
                if($com['Etat'] != 0 && $com['Actif'] == 1){
                    echo "<li><img src=\"images/" . $images[$com['Etat']] . ".svg\" title=\"" . $com['Service'] . "\" alt=\"" .$com['Service']. "\" height=\"20px\" style=\"vertical-align:middle\"> - <strong>".$com['Service']."</strong> - <i>Last Update : ".$com['LastUpdated']."</i> - Update Type : <strong>".$com['ChangeType']."</strong><ul>";
                    if(!empty($com['Commentaire'])){
                        echo "<li> ".$com['Commentaire']."</ul></li><p/>";
                    } else {
                        echo "</ul><p/>";
                    }
                } else {
                    if($com['Actif'] == 0){
                        echo "<li style='color:red'><strong >".$com['Service']."</strong> - <i>Last Update : ".$com['LastUpdated']."</i> - Update Type : <strong>Desactivation</strong><ul>";

                        if(!empty($com['Commentaire'])){
                        echo "<li> ".$com['Commentaire']."</ul></li><p/>";
                        } else {
                        echo "</ul><p/>";
                        }
                    } else {
                        echo "<li style='color:green'><strong >".$com['Service']."</strong> - <i>Last Update : ".$com['LastUpdated']."</i> - Update Type : <strong>Activation</strong><ul>";

                        if(!empty($com['Commentaire'])){
                        echo "<li> ".$com['Commentaire']."</ul></li><p/>";
                        } else {
                        echo "</ul><p/>";
                        }
                    }
                }
            }
            
        }

    }
}

    function refresh($servID){
        $id = $servID;

    }
?>

 