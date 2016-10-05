<!DOCTYPE HTML>
<html lang="fr">

<head>
        <title>Météo des Services CNRS | En cours de maintenance</title>
        <link href="../css/style.css" type="text/css" rel="stylesheet" />

    </head>

    <body>

        <header>

            <h1>Météo des Services CNRS | WIP</h1>
            <nav style='clear:left'>
                <div id="menu">
                    <ul id="onglets">
                        <li><a href="index.php">Dashboard Météo</a></li>
                        <li><a href="admin_meteo.php">Administration</a></li>
                        <li  class="active"><a href="updates.php">Historique de modifications</a></li>
                    </ul>
                </div>
            </nav>
        </header>

	<section class="chooseservice">
		<form method="post" action="updates.php">
	        <input type="hidden" name="tri" value="id">
        	<select name="chooseservice" id="chooseservice">
        		 <option value="" selected="true" disabled="disabled">Choisir un service</option>
                 <option value="">Tous les services</option>
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
                              }
                        ?>
                    ?>
                    
             </select>

            <input type="submit" value="Trier" name="triMit"/>

		</form>
    </section>
		<section id="dashcom" style='float:left'>
            <div class="history">
                <ul>
                	<?php $display = new display();
                     $display->printCom($com, $servID); ?>
                </ul>
            </div>
            </section>


    </body>
</html>