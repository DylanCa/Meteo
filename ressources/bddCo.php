<?php 

class bddCo{
    
   public function __construct(){ 
       $this->bdd = new PDO('mysql:host=localhost;dbname=meteodesservicescnrs;charset=utf8', 'root', ''); 
   }
   

    function getListServices(){
       
        $services = $this->bdd->query('SELECT * FROM Meteo ORDER BY Service');
        $tab = [];
         while($data = $services->fetch())
         { 
             $tab[$data['ID']] = $data;
         }
        return $tab;
    }

    function getComList(){
       
        $com = $this->bdd->query('SELECT meteo.ID, meteo.Service, historique.Etat, historique.Commentaire, historique.LastUpdated, historique.LastUpdatedBy, historique.Actif, historique.ChangeType FROM historique RIGHT JOIN meteo ON meteo.ID = historique.Service WHERE historique.LastUpdated IS NOT NULL ORDER BY historique.ID DESC');
                
        $data = $com->fetchAll();
        
        return $data;
    }
    
    function modifMit($etatmod, $com, $lastupby, $website, $modserv){
       
        date_default_timezone_set('CET');
        $RawLastUp = new DateTime();
        $LastUp = $RawLastUp->format('H:i d-m-Y');

        $sql = "UPDATE Meteo SET Etat = '".$etatmod."', Commentaire = '".$com."', LastUpdated = '".$LastUp."', LastUpdatedBy = '".$lastupby."', Website = '".$website."' WHERE ID = '".$modserv."'";

        $histo = "INSERT INTO Historique(Service, Etat, Commentaire, LastUpdated, LastUpdatedBy, Website, ChangeType) VALUES('".$modserv."','".$etatmod."', '".$com."','".$LastUp."','".$lastupby."','".$website."','Modification')";

        $updb = $this->bdd->query($sql);
        $updb = $this->bdd->query($histo);
    }
    
    function addMit($servadd, $gostate, $lastupby, $addwebsite){
       
        date_default_timezone_set('CET');
        $RawLastUp = new DateTime();
        $LastUp = $RawLastUp->format('H:i d-m-Y');

        $checksql = "SELECT * FROM Meteo WHERE Service = '".$_POST['servadd']."'";

        $nbrow = $this->bdd->query($checksql)->rowCount();

        if($nbrow == 0){

        $sql = "INSERT INTO Meteo (Service, Etat, LastUpdated, LastUpdatedBy, Website) VALUES ('".$servadd."', '".$gostate."', '".$LastUp."', '".$lastupby."', '".$addwebsite."')";

            $updb = $this->bdd->query($sql);

            $srv = $this->bdd->lastInsertId();

            $histo = "INSERT INTO historique (Service, Etat, LastUpdated, LastUpdatedBy, Website, ChangeType) VALUES ('".$srv."','".$gostate."', '".$LastUp."', '".$lastupby."', '".$addwebsite."','Ajout')";

            $updb = $this->bdd->query($histo);
            
        } // else script JS erreur
    }

    function delMit($servdelete, $lastupby){

        date_default_timezone_set('CET');
        $RawLastUp = new DateTime();
        $LastUp = $RawLastUp->format('H:i d-m-Y');

    	$sql = "UPDATE Meteo SET Actif = 1-Actif WHERE ID = '".$servdelete."'";
        

    	$updb = $this->bdd->query($sql);

        $sql = "SELECT Actif FROM Meteo WHERE ID = '".$servdelete."'";
        $value = $this->bdd->query($sql);

        $actif = $value->fetchColumn();

        $histo = "INSERT INTO Historique(Service, Actif, LastUpdated, LastUpdatedBy, ChangeType) VALUES('".$servdelete."', '".$actif."', '".$LastUp."','".$lastupby."', 'Activation / Désactivatio')";

        $updb = $this->bdd->query($histo);
    }

    function getWebsite(){
        $modserv = 2;
        $sql = "SELECT Website FROM Meteo WHERE ID = '".$modserv."'";

        $updb = $this->bdd->query($sql);

        return $result = $updb->fetchColumn();
    }
} ?>