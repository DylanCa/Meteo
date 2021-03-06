<?php

class bddCo{

    var $user = '';
    var $mail = '';
    var $role = '';
    var $logged = 0;

public function __construct(){ 
        

       $this->bdd = new PDO('mysql:host=localhost;dbname=meteoservdb_rec;charset=utf8', 'root', '');
 
   }
 

   function getListAdmin(){
        $admin = $this->bdd->query('SELECT * FROM users ORDER BY mail');
            $tab = [];
            while($data = $admin->fetch(PDO::FETCH_ASSOC))
            { 
                $tab[$data['ID']] = $data;
             }
             return $tab;
   }

   function checkUser(){

    
        if(isset($_SERVER['HTTP_MAIL'])){
            $check = $this->bdd->query("SELECT Prenom, Nom, Role FROM users WHERE Mail = '".$_SERVER['HTTP_MAIL']."'");


            $user = $check->fetch();
            $this->user = $user['Prenom']. " " .$user['Nom'];
            $this->role = $user['Role'];
            $this->mail = $_SESSION['user'];
            $this->logged = 1;
        }
   }

    function getListServices(){
       
        $services = $this->bdd->query('SELECT * FROM meteo ORDER BY Service');
        $tab = [];
         while($data = $services->fetch(PDO::FETCH_ASSOC))
         { 
             $tab[$data['ID']] = $data;
         }
        return $tab;
    }

    function getComList(){
       
        $req = 'SELECT meteo.ID, meteo.Service, historique.Etat, historique.Commentaire, historique.LastUpdated, historique.Website, historique.LastUpdatedBy, historique.Actif, historique.ChangeType FROM historique RIGHT JOIN meteo ON meteo.ID = historique.Service WHERE historique.LastUpdated IS NOT NULL ORDER BY historique.ID DESC';
         
        $nbrow = $this->bdd->query($req)->rowCount();

        if($nbrow != 0){
            $data = $this->bdd->query($req)->fetchAll();
        } else { $data = 0; }

        return $data;
    }
    
    function modifMit($etatmod, $com, $lastupby, $website, $modserv){
       
        date_default_timezone_set('CET');
        $RawLastUp = new DateTime();
        $LastUp = $RawLastUp->format('H:i d-m-Y');

        $sql = "UPDATE meteo SET Etat = '".$etatmod."', Commentaire = '".$com."', LastUpdated = '".$LastUp."', LastUpdatedBy = '".$lastupby."', Website = '".$website."' WHERE ID = '".$modserv."'";

        $histo = "INSERT INTO historique(Service, Etat, Commentaire, LastUpdated, LastUpdatedBy, Website, ChangeType) VALUES('".$modserv."','".$etatmod."', '".$com."','".$LastUp."','".$lastupby."','".$website."','Modification')";

        $updb = $this->bdd->query($sql);
        $updb = $this->bdd->query($histo);
    }
    
    function addMit($servadd, $gostate, $lastupby, $addwebsite){
       
        date_default_timezone_set('CET');
        $RawLastUp = new DateTime();
        $LastUp = $RawLastUp->format('H:i d-m-Y');

        $checksql = "SELECT * FROM meteo WHERE Service = '".$_POST['servadd']."'";

        $nbrow = $this->bdd->query($checksql)->rowCount();

        if($nbrow == 0){

        $sql = "INSERT INTO meteo (Service, Etat, LastUpdated, LastUpdatedBy, Website) VALUES ('".$servadd."', '".$gostate."', '".$LastUp."', '".$lastupby."', '".$addwebsite."')";

            $updb = $this->bdd->query($sql);

            $srv = $this->bdd->lastInsertId();

            $histo = "INSERT INTO historique(Service, Etat, LastUpdated, LastUpdatedBy, Website, ChangeType) VALUES ('".$srv."','".$gostate."', '".$LastUp."', '".$lastupby."', '".$addwebsite."','Ajout')";

            $updb = $this->bdd->query($histo);
            
        } // else script JS erreur
    }

    function delMit($servdelete, $lastupby){

        date_default_timezone_set('CET');
        $RawLastUp = new DateTime();
        $LastUp = $RawLastUp->format('H:i d-m-Y');

    	$sql = "UPDATE meteo SET Actif = 1-Actif WHERE ID = '".$servdelete."'";
        

    	$updb = $this->bdd->query($sql);

        $sql = "SELECT Actif FROM meteo WHERE ID = '".$servdelete."'";
        $value = $this->bdd->query($sql);

        $actif = $value->fetchColumn();

        $histo = "INSERT INTO historique(Service, Actif, LastUpdated, LastUpdatedBy, ChangeType) VALUES('".$servdelete."', '".$actif."', '".$LastUp."','".$lastupby."', 'On/Off')";

        $updb = $this->bdd->query($histo);
    }

    function addmin($name, $surname, $mail, $role){
       
        $checksql = "SELECT * FROM users WHERE Mail = '".$mail."'";

        $nbrow = $this->bdd->query($checksql)->rowCount();

       if($nbrow == 0){
            $sql = "INSERT INTO users(Nom, Prenom, Mail, Role) VALUES('".$name."','".$surname."','".$mail."',".$role.")";

            $updb = $this->bdd->query($sql);
        } // else script erreur
    }

    function modifadmin($role, $nom, $prenom, $mail, $id){
        $sql = "UPDATE users SET Role = '".$role."', Nom = '".$nom."', Prenom = '".$prenom."', Mail = '".$mail."' WHERE ID = ".$id;

            $updb = $this->bdd->query($sql);
    }

    function deladmin($id){
        $sql = "DELETE FROM users WHERE ID = ".$id;

        $updb = $this->bdd->query($sql);
    }

    function getWebsite(){
        $modserv = 2;
        $sql = "SELECT Website FROM meteo WHERE ID = '".$modserv."'";

        $updb = $this->bdd->query($sql);

        return $result = $updb->fetchColumn();
    }
} ?>
