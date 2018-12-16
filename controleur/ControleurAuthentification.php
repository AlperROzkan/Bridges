<?php
require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/Modele.php";
require_once PATH_MODELE . "/Villes.php";

/**
 * Class ControleurAuthentification
 * Controle l'authentification au jeu Bridges.
 */
class ControleurAuthentification
{
    private $vue;
    private $modele;
    private $villes; // On ne met que villes ici car il y a deja un "require ville.php" dans villes.php

    /**
     * Constructeur de ControleurAuthentification.
     * @throws ConnexionException
     */
    function __construct()
    {
        $this->vue = new Vue();
        $this->modele = new Modele();
        $this->villes = new Villes();
    }

    /**
     * Une fois appelée cette methode redirge l'utilisateur :
     * - vers la page de login si il n'est pas connecte,
     * - vers la page de login avec un message d'erreur si il s'est connecte avec les mauvais login et mot de passe,
     * - vers le jeu si il a utilise les bon login et mot de passe
     * @throws TableAccesException
     */
    function accueil()
    {
        if (isset($_SESSION['pseudo'])) {
            $this->vue->commenceJeu($this->villes, false);
        } else if (!empty($_POST["pseudo"]) && $this->modele->exists($_POST["pseudo"]) && (crypt($_POST["mdp"], $this->modele->getMdp($_POST["pseudo"])) == $this->modele->getMdp($_POST["pseudo"]))) {
            $_SESSION['pseudo'] = $_POST["pseudo"];
            $this->vue->commenceJeu($this->villes, false);
        } else if (!isset($_SESSION['pseudo']) && (!empty($_POST["pseudo"]) || !empty($_POST["mdp"]))) {
            $this->vue->demandeLogin(true);
        } else {
            $this->vue->demandeLogin(false);

        }
    }
}
