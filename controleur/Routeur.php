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
        try {
            $this->ControleurAuthentification->accueil();
        } catch (TableAccesException $exception) {
            echo "TableAccesException dans Routeur.php <br>";
            var_dump($this);
        }
    }
}

?>
