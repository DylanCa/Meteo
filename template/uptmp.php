<!DOCTYPE HTML>
<html lang="fr">

    <head>
        <title>Météo des Services CNRS | En cours de maintenance</title>
        <link href="../css/style.css" type="text/css" rel="stylesheet" />  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <script src="./ressources/scripts.js"></script>

    </head>
<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

        <div id="menu">
        <div class="pure-menu">
            <ul class="pure-menu-list" style="text-align: center">
                <?php $bddCo->checkUser();
               if($bddCo->logged == 1){
                    echo '<a class="pure-menu-heading" href="?action=logout">Logout</a></li>';
                    echo '<li class="pure-menu-item"><a href="admin_meteo.php" class="pure-menu-link">Administration</a></li>';
                    echo '<li class="pure-menu-item pure-menu-selected"><a href="updates.php" class="pure-menu-link">Historique</a>';
                    } else { echo'<a class="pure-menu-heading log" href="?action=shiblogin">Login</a>'; } 
                ?>
                <li><br /><hr /><br /></li>
                <li class="pure-menu-item"><a href="index.php" class="pure-menu-link">Accueil</a></li>
            </ul>
        </div>
    </div>

        <div id="main">
            <div class="header">
                <h1>Historique</h1>
                <?php if($bddCo->logged == 1){ ?><h2>Les modifications sont mises à jour automatiquement.</h2> <?php } else { ?> <h2>Vous n'avez pas les droits requis.</h2> <?php } ?>
        </div>
        <br />

        <?php if($bddCo->logged == 1){ ?>
    <div class="content">
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
                    <option value="0">Tous les types</option>
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
        </div> <?php } ?>


        <script src="../ressources/scripts.js"></script>
    </body>
</html>
