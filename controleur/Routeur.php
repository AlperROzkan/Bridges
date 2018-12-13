<?php
require_once 'ControleurAuthentification.php';
require_once 'ControleurJeu.php';

/**
 * Classe qui route les requetes
 */
class Routeur
{
    private $ControleurAuthentification;
    private $ControleurJeu;


    function __construct()
    {
        $this->ControleurAuthentification = new ControleurAuthentification();
        $this->ControleurJeu = new ControleurJeu();
    }

    /**
     * Permet de diriger les requetes
     */
    public function routerRequete()
    {
        if(isset($_SESSION['pseudo'])){
            $this->ControleurJeu->selection();            
            
        } else {
            $this->ControleurAuthentification->accueil();
        }
    }
}

?>
