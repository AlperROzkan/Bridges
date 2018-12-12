<?php
require_once 'ControleurAuthentification.php';

/**
 * Classe qui route les requetes
 */
class Routeur
{
    private $ControleurAuthentification;

    function __construct()
    {
        $this->ControleurAuthentification = new ControleurAuthentification();
    }

    /**
     * Permet de diriger les requetes
     */
    public function routerRequete()
    {
        $this->ControleurAuthentification->accueil();
    }
}

?>
