<?php

class Vue
{

    /**
     * Gere l'authentification du jeu
     */
    function demandeLogin()
    {
        require "Authentification.php";
    }

    /**
     * Gere le jeu en lui même
     * @param $villes
     */
    function commenceJeu($villes)
    {
        require "Jeu.php";
    }
}

?>
