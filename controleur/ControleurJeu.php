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
        if (!isset($_SESSION['villes'])) {
            $_SESSION['villes'] = $this->villes;
        }
        if (isset($_POST["deco"])) {
            session_unset();
            $this->vue->demandeLogin(false);
        } else if (!isset($_POST['villeId'])) {
            $this->vue->commenceJeu($_SESSION['villes']);
        } else {
            if (!isset($_SESSION['actif'])) {
                $this->vue->commenceJeu($_SESSION['villes']);
                $_SESSION['actif'] = $_POST["villeId"];
            } else {
                $_SESSION['villes']->getVilleById($_SESSION['actif'])->lieVille($_SESSION['villes']->getVilleById($_POST['villeId']));
                $_SESSION['villes']->getVilleById($_POST['villeId'])->lieVille($_SESSION['villes']->getVilleById($_SESSION['actif']));
                var_dump($_SESSION['villes']->getVilleById($_POST['villeId']));
                echo "<br><br>";
                var_dump($_SESSION['villes']->getVilleById($_SESSION['actif']));
                echo "<br><br>";
                $this->vue->commenceJeu($_SESSION['villes']);
                echo "<br><br>";
                //var_dump($_SESSION['villes']->getPonts());
                echo $res += array(1,1);
                unset($_SESSION['actif']);

            }


        }


    }
}
