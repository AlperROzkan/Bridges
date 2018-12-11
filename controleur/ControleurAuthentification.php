<?php
require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/Modele.php";
require_once PATH_MODELE . "/Villes.php";

class ControleurAuthentification
{

    private $vue;
    private $modele;
    private $villes; // On ne met que villes ici car il y a deja un "require ville.php" dans villes.php

    /**
     * ControleurAuthentification constructor.
     * @throws ConnexionException
     */
    function __construct()
    {
        $this->vue = new Vue();
        $this->modele = new Modele();
        $this->villes = new Villes();
    }

    /**
     * @throws TableAccesException
     */
    function accueil()
    {
      if (isset($_POST["deco"])){
        session_unset();
        $this->vue->demandeLogin(false);
      } else if (isset($_SESSION['pseudo'])){
        $this->vue->commenceJeu($this->villes);
      } else if (!empty($_POST["pseudo"]) && $this->modele->exists($_POST["pseudo"]) && (crypt($_POST["mdp"], $this->modele->getMdp($_POST["pseudo"])) == $this->modele->getMdp($_POST["pseudo"]))) {
          $_SESSION['pseudo'] = $_POST["pseudo"];
<<<<<<< HEAD
          $this->vue->commenceJeu(false);
=======
          $this->vue->commenceJeu($this->villes);
>>>>>>> 71169d1acd9301f8a98bf8c89bddaf13849b5cdf
      } else {
          $this->vue->demandeLogin(true);
        }
    }
}
