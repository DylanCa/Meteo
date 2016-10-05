    <!DOCTYPE HTML>
    <html lang="fr">

    <head>
        <title>L'offre de services aux unités</title>
        <link href="../css/style.css" rel="stylesheet" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>

    <body>



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

            <input type="radio" name="checkonscreen" id="3" onclick="pagechange('delserv')" />
            <label for="case"><strong style="color:green">Activer</strong> / <strong style="color:red">Désactiver un Service</strong></label>
        </header>



        <!--| Section Modifier un Service |-->

        <section id="modserv" class="form" style="visibility:visible; display:block">
            <form method="post" action="admin_meteo.php">
                <input type="hidden" name="act" value="modify">
                <div id="modserv">
                    <label for="modserv">Quel service voulez-vous modifier ?</label>
                    <br />
                    <select name="modserv" id="modserv">
                         <option value="" selected="true" disabled="disabled">Choisir un service</option>
                        <?php foreach($services as $service){
                                if( $service['Actif'] == 1){
                                ?> <option value=" <?= $service['ID']; ?>" style="color:green">
                                    <?= $service['Service']; ?>
                                        </option> <?php 
                                }
                              }
                        ?>
                    </select>
            </div>

            <div id="etat">Dans quel état est ce service ?
                <br />
                <input type="radio" name="etatmod" value="1" id="o1" checked="checked" />
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

            <div id="com">Commentaire à ajouter<textarea name="com" rows="5" cols="30" maxlength="200"></textarea>
            </div>

            <div id="website">Website du service
                <input type="text" name="website" disabled="disabled" />
            </div>

            <div id="lastupby">Nom de l'admin
                <input type="text" name="lastupby" disabled="disabled"/>
            </div>

                <input type="submit" value="Modifier" name="modifMit"/>
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
                    <input type="radio" name="gostate" value="1" id="p1" checked="checked" />
                    <label for="p1"><img src="../images/1-soleil.png" height="40">
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
                
                <div id="lastupby">Nom de l'admin
                    <input type="text" name="lastupby" disabled="disabled"/>
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
                <input type="submit" value="Activer / Désactiver" name="delMit" )/>
            </form>
        </section>
    </body>
    </html>