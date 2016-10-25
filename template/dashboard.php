    <!DOCTYPE HTML>
    <html lang="fr">

   <head>
        <title>Météo des Services CNRS | En cours de maintenance</title>
        <link href="../css/style.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">

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
                } else { echo'<a class="pure-menu-heading log" href="?action=shiblogin">Login</a>'; } 
                ?>
                <li><br /><hr /><br /></li>
                <li class="pure-menu-item pure-menu-selected"><a href="index.php" class="pure-menu-link">Accueil</a></li>

                <li class="pure-menu-item"><a href="updates.php" class="pure-menu-link">Historique</a>
                </li>
            </ul>
        </div>
    </div>

<div id="main">
        <div class="header">
            <h1>Météo des Services</h1>
            <h2>Infos à rajouter ici</h2>
        </div>
</div>
        <section id="dashboard">
            <div id="affichage">
                <ul class="meteo">

                    <?php $display->printServices($services);?>

                </ul>
            </div>
        </section>
    </body>
    </html>
