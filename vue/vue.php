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
    *Affiche la page des résultats
     * @param $gagne bool pour savoir si la partie est gagnée ou perdue
     * @param $ratio ratio partiesgagnées/partiesjouées par le joueur
     * @param $bestPlayers tableau des 3 joueurs ayant le plus de victoires
     * @param $ratiosBestPlayers tableau des ratios partiesgagnées/partiesjouées des 3 joueurs ayant le plus de victoires 
     */
    function resultat($gagne, $ratio, $bestPlayers, $ratiosBestPlayers)
    {
        require "Resultat.php";
    }
}

?>
