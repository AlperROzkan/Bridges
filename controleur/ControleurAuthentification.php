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
        if (isset($_SESSION['pseudo'])) { // on vérifie si la variable de session pseudo est set
            $this->vue->commenceJeu($this->villes, false);  // on actualise la vue pour afficher le jeu. false nous sert à ne pas afficher la ligne d'erreur dans jeu.php
        } else if (!empty($_POST["pseudo"]) && $this->modele->exists($_POST["pseudo"]) && (crypt($_POST["mdp"], $this->modele->getMdp($_POST["pseudo"])) == $this->modele->getMdp($_POST["pseudo"]))) { //on verifie si le pseudo et le mdp sont valides
            $_SESSION['pseudo'] = $_POST["pseudo"]; //le pseudo devient une variable de session
            $this->vue->commenceJeu($this->villes, false); // on actualise la vue pour afficher le jeu. false nous sert à ne pas afficher la ligne d'erreur dans jeu.php
        } else if (!isset($_SESSION['pseudo']) && (!empty($_POST["pseudo"]) || !empty($_POST["mdp"]))) { //si on entre pas un pseudo ou/et un mdp
            $this->vue->demandeLogin(true); // on affiche la vue d'authentification. true sert à afficher l'erreur
        } else {
            $this->vue->demandeLogin(false); // on affiche la vue d'authentification. false sert à ne pas afficher l'erreur

        }
    }
}
