<?php

class Vue
{

    /**
     * Gere l'authentification du jeu
     */
    function demandeLogin($error){
        require "Authentification.php";
    }

    /**
     * Commence une partie
     * @param $villes : villes du jeu
     */
    function commenceJeu($villes)
    {
        require "Jeu.php";
    }
}

?>
