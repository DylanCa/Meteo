<!DOCTYPE HTML>
<html lang="fr">

<head>
        <title>Météo des Services CNRS | En cours de maintenance</title>
        <link href="../css/style.css" type="text/css" rel="stylesheet" />  
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <script src="./ressources/scripts.js"></script>

    </head>

    <body>
        
        <header>
            <h1>Météo des Services CNRS | WIP</h1>
            <nav style='clear:left'>
                <div id="menu">
                    <ul id="onglets">
                        <li><a href="index.php">Dashboard Météo</a></li>
                        <?php $bddCo->checkUser();
                            if($bddCo->logged == 1){
                                echo '<li><a href="admin_meteo.php">Administration</a></li>';}?>
                        <li  class="active"><a href="updates.php">Historique de modifications</a></li>
                    </ul>
                </div>
            </nav>
        </header>

	<section class="chooseservice">
		<form method="post" action="updates.php">
	        <input type="hidden" name="tri" value="id">
        	<select name="chooseservice" id="chooseservice">
        		<option value="0">Tous les services</option>
                    <?php foreach($services as $service){
                            if( $service['Actif'] == 1){
                            ?> <option value="<?= $service['ID']; ?>" style="color:green">
                                <?= $service['Service']; ?>
                                </option> <?php 
                            } else if( $service['Actif'] == 0){
                            ?> <option value="<?= $service['ID']; ?>" style="color:red">
                                <?= $service['Service']; ?>
                                </option> <?php 
                            }
                        }?>   
            </select>            
            <script>lastDDM('chooseservice', <?php echo $_REQUEST['chooseservice'] ?>);</script> 


            <select name="choosemod" id="choosemod">
                <option value="0">Toutes les entrées</option>
                <option value="1">Modifications</option>
                <option value="2">Ajout d'un service</option>
                <option value="3">Activation / Désactivation</option>
            </select>


            <script>lastDDM('choosemod', <?php echo $_REQUEST['choosemod']; ?>);</script>
            <input type="submit" value="Trier" name="triMit"/>

		</form>
    </section>
		<section id="dashcom" style='float:left'>
            <div class="history">
                <ul>
                	<?php $display->printCom($com, $servID, $histoKind); ?>
                </ul>
            </div>
            </section>


    </body>
</html>
