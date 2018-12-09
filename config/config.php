<?php

//Chemin complet sur le serveur de la racine du site, config.php est dans un sous-dossier
define("HOME_SITE",__DIR__."/..");

//Les chemins des repertoires liés au modele MVC
define("PATH_VUE", HOME_SITE."/vue");
define("PATH_CONTROLEUR", HOME_SITE."/controleur");
define("PATH_MODELE", HOME_SITE."/modele");


// données pour la connexion au sgbd (Changer les X a chaque fois pour se connecter)
define("HOST", "localhost");
define("BD", "bridges");
define("LOGIN", "root");
define("PASSWORD", "mysql24passEz");
?>
