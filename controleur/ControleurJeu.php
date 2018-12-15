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
        if (!isset($_SESSION['villes']) && !isset($_POST["deco"]) && !isset($_POST["reset"])) {
            $_SESSION['villes'] = $this->villes;
        }
        // Si l'utilisateur appuie sur le bouton de deconnexion ou pas
        if (isset($_POST["deco"])) {
            if (isset($_SESSION['villes'])){
              $this->modele->ajoutPartie( $_SESSION['pseudo'], false);
            }
            session_unset();
            $this->vue->demandeLogin(false);
        } else if (isset($_POST["reset"])){
            if (isset($_SESSION['villes'])){
              $this->modele->ajoutPartie( $_SESSION['pseudo'], false);
            }
            unset($_SESSION['villes']);
            unset($_SESSION['actif']);
            $_SESSION['villes'] = $this->villes;
            $this->vue->commenceJeu($_SESSION['villes']);
        }
        else if (!isset($_POST['villeId'])) {
            $this->vue->commenceJeu($_SESSION['villes']);
        } else {
            if (!isset($_SESSION['actif'])) {
                $this->vue->commenceJeu($_SESSION['villes']);
                $_SESSION['actif'] = $_POST["villeId"];
            } else {
                // On verifie si les deux villes sont liables
                if ($this->villes->liable($this->villes->findVilleById($_SESSION['actif'])[0], $this->villes->findVilleById($_SESSION['actif'])[1], $this->villes->findVilleById($_POST['villeId'])[0], $this->villes->findVilleById($_POST['villeId'])[1], $_SESSION['villes'])) {

                  $perdu = $_SESSION['villes']->perdu($_SESSION['villes']->getVilleById($_SESSION['actif']),$_SESSION['villes']->getVilleById($_POST['villeId']));

                    // On appelle lieVille sur les deux villes afin que leurs attribut villeLiees soient toutes deux mises a jour
                    $_SESSION['villes']->getVilleById($_SESSION['actif'])->lieVille($_SESSION['villes']->getVilleById($_POST['villeId']));
                    var_dump($this->modele->stat($_SESSION['pseudo']));
                } else {
                  echo "<br> Les deux villes ne sont pas liables <br>";
                }
                $_SESSION['villes']->getPonts();
                if ($_SESSION['villes']->gagne()){
                  //$this->vue->resultat(true, $this->modele->stat($_SESSION['pseudo']));
                  unset($_SESSION['villes']);
                  $this->modele->ajoutPartie( $_SESSION['pseudo'], true);
                } else if ($perdu) {
                    //$this->vue->resultat(false,$this->modele->stat($_SESSION['pseudo']));
                    unset($_SESSION['villes']);
                    $this->modele->ajoutPartie( $_SESSION['pseudo'], false);
                }
                else {
                  $this->vue->commenceJeu($_SESSION['villes']);
                }
                unset($_SESSION['actif']);
            }
        }
    }
}
