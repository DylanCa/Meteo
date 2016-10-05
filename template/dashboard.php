    <!DOCTYPE HTML>
    <html lang="fr">

    <head>
        <title>Météo des Services CNRS | En cours de maintenance</title>
        <link href="../css/style.css" type="text/css" rel="stylesheet" />
    </head>

    <body>



        <header>
            <h1>Météo des Services CNRS | WIP</h1>
            <nav>
                <div id="menu">
                    <ul id="onglets">
                        <li class="active"><a href="index.php">Dashboard Météo</a></li>
                        <li><a href="admin_meteo.php">Administration</a></li>
                        <li><a href="updates.php">Historique de modifications</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <section id="dashboard">
            <div id="affichage">
                <ul class="meteo">

                    <?php $display = new display();
                    $display->printServices($services);?>

                </ul>
            </div>
        </section>
    </body>
    </html>