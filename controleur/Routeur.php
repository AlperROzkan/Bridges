<?php
require_once 'ControleurAuthentification.php';
require_once 'ControleurJeu.php';

/**
 * Classe qui route les requetes.
 */
class Routeur
{
    private $ControleurAuthentification;
    private $ControleurJeu;

    /**
     * Constructeur de Routeur.
     * Permet d'instancier les controleurs.
     * @throws ConnexionException
     */
    function __construct()
    {
        $this->ControleurAuthentification = new ControleurAuthentification();
        $this->ControleurJeu = new ControleurJeu();
    }

    /**
     * Permet de diriger les requetes.
     */
    public function routerRequete()
    {
        if(isset($_SESSION['pseudo'])){ //si on est connecté
            $this->ControleurJeu->selection();//on lance le controleur du jeu

        } else {
            $this->ControleurAuthentification->accueil(); //on lance le controleur de l'authentification
        }
    }
}

?>
