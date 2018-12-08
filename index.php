<?php


require "config/config.php";
require PATH_CONTROLEUR . "/Routeur.php";

session_start();
$routeur = new Routeur();
$routeur->routerRequete();


?>
