<!DOCTYPE HTML>
<html lang="fr">

<head>
    <title>Météo des Services CNRS | En cours de maintenance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" type="text/css" rel="stylesheet" />
  
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
                    echo '<a class="pure-menu-heading" href="/index.php?action=logout">Logout</a></li>';
                    echo '<li class="pure-menu-item"><a href="/admin/admin_meteo.php" class="pure-menu-link">Administration</a></li>';
                    echo '<li class="pure-menu-item"><a href="/admin/updates.php" class="pure-menu-link">Historique</a>';
                    } else { echo'<a class="pure-menu-heading log" href="/admin/admin_meteo.php?action=shiblogin">Login</a>'; } 
                ?>
                <li><br /><hr /><br /></li>
                <li class="pure-menu-item pure-menu-selected"><a href="index.php" class="pure-menu-link">Accueil</a></li>
            </ul>
        </div>
    </div>

<div id="main">
        <div class="header">
            <h1>Météo des Services</h1>
            <h2>Les différents états des services fournis par la DSI du CNRS.</h2>
        </div>
</div>
        <section id="dashboard">
            <div id="affichage">
                <ul class="meteo">

                    <?php $display->printServices($services);?>

                </ul>
            </div>
        </section>
        <script src="../ressources/scripts.js"></script>
    </body>
    </html>


