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
     * Gere le jeu en lui même
     */
    function commenceJeu($bonjour){
        require "Jeu.php";
    }

}

?>
