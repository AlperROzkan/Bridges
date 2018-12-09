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

    function test()
    {
        require "Test.php";
    }

    /**
     * Gere le jeu en lui même
     */
    function commenceJeu()
    {
        require "Jeu.php";
    }
}

?>