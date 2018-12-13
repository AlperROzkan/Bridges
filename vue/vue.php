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

    function test($ville1, $ville2)
    {
       var_dump($ville1);
       echo "<br><br>";
       var_dump($ville2);

       
    }


}

?>
