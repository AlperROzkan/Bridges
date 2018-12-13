<?php
require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/Modele.php";
require_once PATH_MODELE . "/Villes.php";

class ControleurJeu
{

    private $vue;
    private $modele;
    private $villes; // On ne met que villes ici car il y a deja un "require ville.php" dans villes.php

    /**
     * ControleurJeu constructor.
     * @throws ConnexionException
     */
    function __construct()
    {
        $this->vue = new Vue();
        $this->modele = new Modele();
        $this->villes = new Villes();
    }


    function selection()
    {
        if (isset($_POST["deco"])) {
            session_unset();
            $this->vue->demandeLogin(false);
        } else if (!isset($_POST['villeId'])) {
            $this->vue->commenceJeu($this->villes);
        } else {
            if (!isset($_SESSION['actif'])) {
                $this->vue->commenceJeu($this->villes);
                $_SESSION['actif'] = $_POST["villeId"];
            } else {
                $this->villes->getVilleById($_SESSION['actif'])->lieVille($this->villes->getVilleById($_POST['villeId']));
                $this->villes->getVilleById($_POST['villeId'])->lieVille($this->villes->getVilleById($_SESSION['actif']));
                var_dump($this->villes->getVilleById($_POST['villeId']));
                echo "<br><br>";
                var_dump($this->villes->getVilleById($_SESSION['actif']));
                $this->vue->commenceJeu($this->villes);
                unset($_SESSION['actif']);

            }


        }


    }
}
