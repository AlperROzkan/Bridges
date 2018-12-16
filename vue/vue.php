<?php

class Vue
{

    /**
     * Gere l'authentification du jeu
     * @param $error : Ce parametre permet de savoir si l'utilisateur s'est trompé de login et/ou de mot de passe lors de l'authenification
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

    /**
     * @param $gagne
     * @param $ratio
     * @param $bestPlayers
     * @param $ratiosBestPlayers
     */
    function resultat($gagne, $ratio, $bestPlayers, $ratiosBestPlayers)
    {
        require "Resultat.php";
    }
}

?>
