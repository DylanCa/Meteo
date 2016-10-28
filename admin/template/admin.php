    <!DOCTYPE HTML>
    <html lang="fr">

    <head>
        <title>L'offre de services aux unités</title>
        <link href="/css/style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Si pas internet : <script src="/ressources/jquery-3.1.1.min.js"></script> -->
        
    </head>

    <body>
<?php echo "<script>";
    echo "var tab = {\n";
    foreach($services as $service){
       echo $service['ID']." : {Website : \"".$service['Website']."\", LastUpdatedBy : \"".$service['LastUpdatedBy']."\", Commentaire : \"".$service['Commentaire']."\", Etat : \n".$service['Etat']."\n},\n";
    }

    echo "};\n";
    echo "</script>"; ?>


<?php echo "<script>";
    echo "var admintab = {\n";
    foreach($admin as $admintab){
        echo $admintab['ID']." : {Mail : \"".$admintab['Mail']."\", Nom : \"".$admintab['Nom']."\", Prenom : \"".$admintab['Prenom']."\", Role : ".$admintab['Role']."\n},\n";
    }

    echo"};\n";
    echo "</script>"; ?>

        <!--| Section Onglets + choix formulaire |-->

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
                    echo '<a class="pure-menu-heading" href="/index.php?action=logout">Logout</a></li>';
                    echo '<li class="pure-menu-item pure-menu-selected"><a href="/admin/admin_meteo.php" class="pure-menu-link">Administration</a></li>';
                    echo '<li class="pure-menu-item"><a href="/admin/updates.php" class="pure-menu-link">Historique</a>';
                    } else { echo'<a class="pure-menu-heading log" href="?action=shiblogin">Login</a>'; } 
                ?>
                <li><br /><hr /><br /></li>
                <li class="pure-menu-item"><a href="/index.php" class="pure-menu-link">Accueil</a></li>

                <li><br /><hr /><br /></li>

                <?php if(isset($bddCo->user) && ($bddCo->role == 1 || $bddCo->role == 2 )){ ?>
                <h5>
                <li class="pure-menu-item"><a href="#" onclick="pagechange('modserv');" class="pure-menu-link">Modifier un Service</a></li>

                <li class="pure-menu-item"><a href="#" onclick="pagechange('addserv');" class="pure-menu-link">Ajouter un Service</a></li>

                <li class="pure-menu-item"><a href="#" onclick="pagechange('delserv');" class="pure-menu-link"><strong style="color:green">Activer</strong> <strong style="color:red">Désactiver</strong><br />un Service</a></li>
                <?php if($bddCo->role == 1){?><li class="pure-menu-item"><a href="#" onclick="pagechange('addmin');" class="pure-menu-link"><strong>Ajouter un<br/>administrateur</strong>

                <li class="pure-menu-item"><a href="#" onclick="pagechange('deladmin');" class="pure-menu-link"><strong>Modifier / Supprimer<br/>un administrateur</strong>



                <?php }; ?></a></li>
                </li></h5> <?php } ?>
            </ul>
        </div>
    </div>






<div id="main">
        <div class="header">
            <h1>Panneau d'administration</h1>
            <?php if(isset($bddCo->user) && ($bddCo->role == 1 || $bddCo->role == 2 )){ ?>
                    <h2 id="current">Modifier un service existant</h2> <?php } else {
                        ?> <h2>Vous n'avez pas les droits requis.</h2><?php } ?>
                    
        </div>


<?php if(isset($bddCo->user) && ($bddCo->role == 1 || $bddCo->role == 2 )){
    foreach($services as $service){
    
} 
    ?>
    <br />
    <div class="content">




        <!--| Section Modifier un Service |-->
    
        <section id="modserv" class="form" style="visibility:visible; display:block">
            <form method="post" class="pure-form" action="admin_meteo.php">
            <fieldset class="pure-group">
                <input type="hidden" name="act" value="modify">
                <div id="modservdiv">
                    <select required class="pure-input-1-2" name="modservmenu" id="modserv">
                         <option value="" selected="true" disabled="disabled">Choisir un service</option>
                        <?php foreach($services as $service){
                                if( $service['Actif'] == 1){
                                ?> <option value="<?= $service['ID']; ?>" style="color:green"><?= $service['Service']; ?></option>
                                 <?php 
                                }
                              }
                        ?>
                    </select>
                </div>
                <div id="etat">
                    <select class="pure-input-1-2" name="etatmod">
                        <option value="" disabled selected>Etat du service</option>
                         <option value="1" id="o1">Ensoleillé</option>
                         <option value="2" id="o2">Nuageux</option>
                         <option value="3" id="o3">Orageux</option>
                    </select>
                </div>
            </fieldset>

            <br />

            <fieldset class="pure-group">
                <div id="commod">
                    <textarea class="pure-input-1-2" placeholder="Commentaire à ajouter" name="commod" rows="5" cols="30" maxlength="200"></textarea>
                </div>

                <div id="websitediv">
                    <input class="pure-input-1-2" placeholder="Website du service" type="text" name="websitemod"/> <!-- I want to add the website in there --> 
                </div>

                <div id="lastupby"> 
                    <input class="pure-input-1-2" placeholder="Dernière modification par" type="text" name="lastupby" disabled/>
                </div>
            </fieldset>


                <input class="pure-button pure-button-primary" type="submit" value="Modifier" name="modifMit" />
            </form>
       </section>



        <!--| Section Ajouter un Service |-->

        <section id="addserv" class="form" style="visibility:hidden; display:none">
            <form class="pure-form" method="post" action="admin_meteo.php">
            <fieldset class="pure-group">
                <input type="hidden" name="act" value="add">
                <div id="lastup">
                    <input required class="pure-input-1-2" placeholder="Service à ajouter" type="text" name="servadd" />
                </div>

                <div id="etat">
                    <select class="pure-input-1-2" name="gostate">
                        <option value="" disabled selected>Etat initial du service</option>
                         <option value="1" id="p1">Ensoleillé</option>
                         <option value="2" id="p2">Nuageux</option>
                         <option value="3" id="p3">Orageux</option>
                    </select>
                </div>

                <div id="website">
                    <input class="pure-input-1-2" placeholder="Website du service" type="text" name="website" />
                </div>
                
                <div id="addlastupby">
                    <input class="pure-input-1-2" placeholder="Nom de l'admin" type="text" name="addlastupby" disabled="disabled" value=<?php echo '"'.$bddCo->user.'"'; ?>>
                </div>
                </fieldset>

                <input type="submit" class="pure-button pure-button-primary" value="Ajouter" name="addMit" />
            </form>
        </section>



        <!--| Section Supprimer un Service |-->

        <section id="delserv" class="form" style="visibility:hidden; display:none">
            <form class="pure-form pure-form-stacked" method="post" action="admin_meteo.php">
             <div class="pure-g pure-u-1 pure-u-md-1-3">
                <input class="pure-u-23-24" type="hidden" name="act" value="delete">
                <label for="servdelete">Quel service voulez-vous <strong style="color:green">activer</strong> ou <strong style="color:red">désactiver</strong> ?</label>
                <br />
                <select name="servdelete" id="servdelete">
                         <option value="" selected="true" disabled="disabled">Choisir un service</option>
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
                    </select>
                <input type="submit" class="pure-button pure-button-primary" value="Activer / Désactiver" name="delMit">
            </form>
            <div id="histodel"><ul></ul></div>
        </section>

        <!--| Section Ajout Administrateurs |-->

	<?php if($bddCo->role == 1){ ?>

    <section id="addmin" class="form" style="visibility:hidden; display:none">
    	    <form class="pure-form pure-form-stacked" method="post" action="admin_meteo.php">
                <div class="pure-g">
                    <input type="hidden" name="act" value="addmin">
                    <div class="pure-u-1 pure-u-md-1-3" id="surnameadmin">Prénom de l'administrateur
                        <input class="pure-u-23-24" type="text" required name="surnameadmin">
                    </div>
                    <div class="pure-u-1 pure-u-md-1-3" id="nameadmin">Nom de l'administrateur
                        <input class="pure-u-23-24" type="text" required name="nameadmin">
                    </div>
                    <div class="pure-u-1 pure-u-md-1-3" id="mailadmin">Mail de l'administrateur
                        <input class="pure-u-23-24" type="email" required name="mailadmin">
                    </div>
                    <div required class="pure-u-1 pure-u-md-1-3" id="rank">Sera-t-il super-administrateur ?
                        <input type="radio" name="superadmin" value="1" id="yes"/> Oui
                        <input type="radio" name="superadmin" value="2" id="no"/> Non
                    </div>
                    <input type="submit" class="pure-button pure-button-primary" value="Ajouter Admin" name="adminMit" />
                </div>
            </form>
        </section>

<!-- Modifier / Supprimer admin -->

        <section id="deladmin" class="form" style="visibility:hidden; display:none">
        <form method="post" class="pure-form" action="admin_meteo.php">
            <fieldset class="pure-group">
                <input type="hidden" name="act" value="modadmin">
                <div class="pure-g">
                    <select required class="pure-input-1-2" name="addmin" id="addmin">
                         <option value="" selected="true" disabled="disabled">Choisir un administrateur</option>
                        <?php foreach($admin as $admintab){
                                if( $service['Actif'] == 1){
                                ?> <option value="<?= $admintab['ID']; ?>" style="color:green"><?= $admintab['Mail']; ?></option>
                                 <?php 
                                }
                              }
                        ?>
        </select> </div>

        </fieldset>
        <fieldset class="pure-group">
        <div id="role">
            <select class="pure-input-1-2" name="roleadmin">
                <option value="" disabled selected>Rôle de l'administrateur</option>
                 <option value="1" id="a1">Super-admin</option>
                 <option value="2" id="a2">Administrateur classique</option>
            </select>
        </div>

        <div id="nomadmin">
            <input type="text" class="pure-input-1-2" placeholder="Nom" name="nomadmin" />
        </div>

        <div id="prenomadmin">
            <input class="pure-input-1-2" placeholder="Prénom" type="text" name="prenomadmin"/> 
        </div>

        <div id="mailadmin"> 
            <input class="pure-input-1-2" placeholder="Mail" type="email" name="delmailadmin" />
        </div>
        <br /><br />

        </fieldset>
        <br />
        <input type="submit" class="pure-button pure-button-primary" value="Modifier" name="addadminMit" /> 
        <input type="submit" style="background: rgb(202, 60, 60); color:white" value="Supprimer administrateur" class="button-error pure-button" name="deladminMit" />
            </form>
        </section>




        <?php }; }?>
        <script src="/ressources/scripts.js"></script>
    </body>
    </html>
