<?php

//Chemin complet sur le serveur de la racine du site, config.php est dans un sous-dossier
define("HOME_SITE",__DIR__."/..");

//Les chemins des repertoires liés au modele MVC
define("PATH_VUE", HOME_SITE."/vue");
define("PATH_CONTROLEUR", HOME_SITE."/controleur");
define("PATH_MODELE", HOME_SITE."/modele");


// Données pour la connexion au sgbd
define("HOST", "localhost");
define("BD", "E175980H"); // Changer la valeur ici par son nom de Base de Données
define("LOGIN", "E175980H"); // Changer la valeur ici par son login de phpmyadmin
define("PASSWORD", "E175980H"); // Changer la valeur ici par son mot de passe de phpmyadmin
?>
