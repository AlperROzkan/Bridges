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
        // On regarde si les villes sont dans une variable de session ou non
        if (!isset($_SESSION['villes'])) {
            $_SESSION['villes'] = $this->villes;
        }
        // Si l'utilisateur appuie sur le bouton de deconnexion ou pas
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
                // On verifie si les deux villes sont liables
                var_dump($this->villes->findVilleById($this->villes->getVilleById($_SESSION['actif']))[0]);
                echo "<br><br>";
                var_dump($this->villes->findVilleById($this->villes->getVilleById($_SESSION['actif']))[1]);
                echo "<br><br>";
                var_dump($this->villes->findVilleById($this->villes->getVilleById($_POST['villeId']))[0]);
                echo "<br><br>";
                var_dump($this->villes->findVilleById($this->villes->getVilleById($_POST['villeId']))[1]);
                echo "<br><br>";

                if ($this->villes->liable($this->villes->findVilleById($this->villes->getVilleById($_SESSION['actif']))[0], $this->villes->findVilleById($this->villes->getVilleById($_SESSION['actif']))[1], $this->villes->findVilleById($this->villes->getVilleById($_POST['villeId']))[0], $this->villes->findVilleById($this->villes->getVilleById($_POST['villeId']))[1])) {
                    // On appelle lieVille sur les deux villes afin que leurs attribut villeLiees soient toutes deux mises a jour
                    $_SESSION['villes']->getVilleById($_SESSION['actif'])->lieVille($_SESSION['villes']->getVilleById($_POST['villeId']));
                    $_SESSION['villes']->getVilleById($_POST['villeId'])->lieVille($_SESSION['villes']->getVilleById($_SESSION['actif']));
                }
                else {
                    echo "<br> Les deux villes ne sont pas liables <br>";
                }

                var_dump($_SESSION['villes']->getVilleById($_POST['villeId']));
                echo "<br><br>";
                var_dump($_SESSION['villes']->getVilleById($_SESSION['actif']));
                echo "<br><br>";
                //  $_SESSION['villes']->getPonts();


                $this->vue->commenceJeu($_SESSION['villes']);
                echo "<br><br>";
                //var_dump($_SESSION['villes']->getPonts());

                unset($_SESSION['actif']);

            }


        }


    }
}
