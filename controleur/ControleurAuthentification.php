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
        if (!empty($_POST["pseudo"]) && $this->modele->exists($_POST["pseudo"]) && (crypt($_POST["mdp"], $this->modele->getMdp($_POST["pseudo"])) == $this->modele->getMdp($_POST["pseudo"]))) {
            $_SESSION['pseudo'] = $_POST["pseudo"];
            $this->vue->test();

        } else {
            $this->vue->demandeLogin();
        }

    }


}