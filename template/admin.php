    <!DOCTYPE HTML>
    <html lang="fr">

    <head>
        <title>L'offre de services aux unités</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Si pas internet : <script src="/ressources/jquery-3.1.1.min.js"></script> -->
        
        <script src="/ressources/scripts.js"></script>
    </head>

    <body>
<?php echo "<script>";
    echo "var tab = {\n";
    foreach($services as $service){
       echo $service['ID']." : {Website : \"".$service['Website']."\", LastUpdatedBy : \"".$service['LastUpdatedBy']."\", Commentaire : \"".$service['Commentaire']."\", Etat : \n".$service['Etat']."\n},\n";
    }

    echo "};";
    echo "</script>"; ?>

        <!--| Section Onglets + choix formulaire |-->

        <header>
            <h1>Panneau d'Admin de la Météo des Services | WIP</h1>
            <nav>
                <div id="menu">
                    <ul id="onglets">
                        <li><a href="index.php">Dashboard Météo</a></li>
                        <li class="active"><a href="admin_meteo.php">Administration</a></li>
                        <li><a href="updates.php">Historique de modifications</a></li>
                    </ul>
                </div>
            </nav>

            <input type="radio" name="checkonscreen" id="1" checked onclick="pagechange('modserv');" />
            <strong><label for="case">Modifier un Service</label></strong>

            <input type="radio" name="checkonscreen" id="2" onclick="pagechange('addserv');" />
            <strong><label for="case">Ajouter un Service</label></strong>

            <input type="radio" name="checkonscreen" id="3" onclick="pagechange('delserv');" />
            <label for="case"><strong style="color:green">Activer</strong> / <strong style="color:red">Désactiver un Service</strong></label>

           <?php if($bddCo->role == 1){?> <input type="radio" name="checkonscreen" id="2" onclick="pagechange('modadmin');" />
            <strong><label for="case">Ajouter un administrateur</label></strong><?php }; ?>
        </header>

<?php foreach($services as $service){
    
} 
    ?>
        <!--| Section Modifier un Service |-->

        <section id="modserv" class="form" style="visibility:visible; display:block">
            <form method="post" action="admin_meteo.php">
                <input type="hidden" name="act" value="modify">
                <div id="modservdiv">
                    <label for="modservmenu">Quel service voulez-vous modifier ?</label>
                    <br />
                    <select name="modservmenu" id="modserv">
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

            <div id="etat">Dans quel état est ce service ?
                <br />
                <input type="radio" name="etatmod" value="1" id="o1" />
                <label for="o1"><img src="../images/1-soleil.png" height="40">
                    <br />
                </label>

                <input type="radio" name="etatmod" value="2" id="o2" />
                <label for="o2"><img src="../images/2-couvert.png" height="40">
                    <br />
                </label>

                <input type="radio" name="etatmod" value="3" id="o3" />
                <label for="o3"><img src="../images/3-orage.png" height="40">
                    <br />
                </label>
            </div>

            <div id="commod">Commentaire à ajouter
                <textarea name="commod" rows="5" cols="30" maxlength="200"></textarea>
            </div>

            <div id="websitediv">Website du service
                <input type="text" name="websitemod"/> <!-- I want to add the website in there --> 
            </div>

            <div id="lastupby">Dernière modification par : 
                <input type="text" name="lastupby" disabled/>
            </div>

                <input type="submit" value="Modifier" name="modifMit" />
            </form>
       </section>



        <!--| Section Ajouter un Service |-->

        <section id="addserv" class="form" style="visibility:hidden; display:none">
            <form method="post" action="admin_meteo.php">
                <input type="hidden" name="act" value="add">
                <div id="lastup">Service à ajouter
                    <input type="text" name="servadd" />
                </div>

                <div id="etat">
                    Etat initial du service
                    <br />
                    <input type="radio" name="gostate" value="1" id="p1"/>
                    <label for="p1" selected="true"><img src="../images/1-soleil.png" height="40">
                        <br />
                    </label>
                    <input type="radio" name="gostate" value="2" id="p2" />
                    <label for="p2"><img src="../images/2-couvert.png" height="40">
                        <br />
                    </label>
                    <input type="radio" name="gostate" value="3" id="p3" />
                    <label for="p3"><img src="../images/3-orage.png" height="40">
                        <br />
                    </label>
                </div>

                <div id="website">Website du service
                    <input type="text" name="website" />
                </div>
                
                <div id="addlastupby">Nom de l'admin
                    <input type="text" name="addlastupby" disabled="disabled" value=<?php echo '"'.$bddCo->user.'"'; ?>>
                </div>

                <input type="submit" value="Ajouter" name="addMit" />
            </form>
        </section>



        <!--| Section Supprimer un Service |-->

        <section id="delserv" class="form" style="visibility:hidden; display:none">
            <form method="post" action="admin_meteo.php">
                <input type="hidden" name="act" value="delete">
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
                <input type="submit" value="Activer / Désactiver" name="delMit">
            </form>
            <div id="histodel"><ul></ul></div>
        </section>

        <!--| Section Modification Administrateurs |-->

	<?php if($bddCo->role == 1){ ?> <section id="modadmin" class="form" style="visibility:hidden; display:none">
    	    <form method="post" action="admin_meteo.php">
                <input type="hidden" name="act" value="addmin">
                <div id="surnameadmin">Quel est le prénom de l'administrateur à ajouter ?
                    <input type="text" name="surnameadmin">
                </div>
                <div id="nameadmin">Quel est le nom de l'administrateur à ajouter ?
                    <input type="text" name="nameadmin">
                </div>
                <div id="mailadmin">Quel est l'adresse mail de l'administrateur à ajouter ?
                    <input type="email" placeholder="Mail" required name="mailadmin">
                </div>
                <div id="rank">Sera-t-il super-administrateur ?
                    <input type="radio" name="superadmin" value="1" id="yes"/> Yes
                    <input type="radio" name="superadmin" value="2" id="no"/> No
                </div>
                <input type="submit" value="Ajouter Admin" name="adminMit" />
            </form>
        </section><?php }; ?>
    </body>
    </html>
