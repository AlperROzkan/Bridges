<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/Modele.php";

class ControleurAuthentification
{

    private $vue;
    private $modele;

    /**
     * ControleurAuthentification constructor.
     * @throws ConnexionException
     */
    function __construct()
    {
        $this->vue = new Vue();
        $this->modele = new Modele();

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
        $this->vue->commenceJeu();
      } else if (!empty($_POST["pseudo"]) && $this->modele->exists($_POST["pseudo"]) && (crypt($_POST["mdp"], $this->modele->getMdp($_POST["pseudo"])) == $this->modele->getMdp($_POST["pseudo"]))) {
          $_SESSION['pseudo'] = $_POST["pseudo"];
          $this->vue->commenceJeu(false);
      } else {
          $this->vue->demandeLogin(true);
        }
    }
}
