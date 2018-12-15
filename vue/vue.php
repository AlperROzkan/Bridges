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
    function commenceJeu($villes, $error)
    {
        require "Jeu.php";
    }

    function resultat($gagne, $ratio, $bestPlayers, $ratiosBestPlayers)
    {
        require "Resultat.php";
    }
}

?>
