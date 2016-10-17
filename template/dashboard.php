    <!DOCTYPE HTML>
    <html lang="fr">

    <head>
        <title>Météo des Services CNRS | En cours de maintenance</title>
        <link href="../css/style.css" type="text/css" rel="stylesheet" />
        <?php $bddCo->checkUser();
        if($bddCo->logged == 1){
            echo '<a> Bienvenue '.$bddCo->user.' !<br /></a>';
            echo '<a href="?action=logout">Se déconnecter</a>';
        } else { echo'<a href="?action=shiblogin">login avec Shibboleth</a>'; } 
        ?>

    </head>

    <body>



        <header>
            <h1>Météo des Services CNRS | WIP</h1>
            <nav>
                <div id="menu">
                    <ul id="onglets">
                        <li class="active"><a href="index.php">Dashboard Météo</a></li>
                        <?php if($bddCo->logged == 1){
                            echo '<li><a href="admin_meteo.php">Administration</a></li>';}?>
                        <li><a href="updates.php">Historique de modifications</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <section id="dashboard">
            <div id="affichage">
                <ul class="meteo">

                    <?php $display->printServices($services);?>

                </ul>
            </div>
        </section>
    </body>
    </html>