<?php
require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/Modele.php";
require_once PATH_MODELE . "/Villes.php";

/**
 * Classe ControleurJeu.
 * Gere les actions du jeu.
 */
class ControleurJeu
{

    private $vue;
    private $modele;
    private $villes; // On ne met que villes ici car il y a deja un "require ville.php" dans villes.php

    /**
     * Constructeur de ControleurJeu
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
        $mmLigne = false; //Variable qui sert pour l'affichage du jeu Si False pas de message d'alerte si true message qui previent que l'on a cliqué sur deux villes qui ne sont ni sur la mm ligne ni sur la mm colonne ont une ville entre elles ou ont un pont dans le sens inverse sur leur trajectoire
        if (!isset($_SESSION['villes']) && !isset($_POST["deco"]) && !isset($_POST["reset"])) { // On verifie si les villes (et donc le jeu) sont déjà en variable de session ou non et si l'utilisateur ne vient pas d'appuyer sur le bouton reset ou déconnexion
            $_SESSION['villes'] = $this->villes;  //on initialise le jeu en le mettant en variable de session pour sauvegarder les actions et les ponts
        }
        if (isset($_POST["deco"])) { //On vérifie si l'utilisateur a appuyé sur le bouton de deconnexion
            if (isset($_SESSION['villes'])) { //si un jeu est en cours
                $this->modele->ajoutPartie($_SESSION['pseudo'], false); //on ajoute un tuple sql. on donne en parametre le pseudo et l'etat de la parti. false = partie perdue
            }
            session_unset(); //on detruit toutes les variables de session
            $this->vue->demandeLogin(false); // on affiche la vue authentification sans essage d'erreur
        } else if (isset($_POST["reset"])) { // si on appuie sur le bouton reset
            if (isset($_SESSION['villes'])) { // on verifie si  un jeu est en cours
                $this->modele->ajoutPartie($_SESSION['pseudo'], false); // on ajoute un tuple sql. on donne en parametre le pseudo et l'etat de la parti. false = partie perdue
            }
            unset($_SESSION['villes']); // on detruit la variable de session liée au jeu
            unset($_SESSION['actif']); // on detruit la variable de session qui garde la ville cliquée
            $_SESSION['villes'] = $this->villes; // on réinitialise le jeu
            $this->vue->commenceJeu($_SESSION['villes'], $mmLigne); // on affiche le jeu. $mmLigne = boolean qui definit si il y le message d'erreur ou non
        } else if (!isset($_POST['villeId'])) { // si on a pas cliqué sur une ville
            $this->vue->commenceJeu($_SESSION['villes'], $mmLigne); // on affiche le jeu. $mmLigne = boolean qui definit si il y le message d'erreur ou non
        } else {
            if (!isset($_SESSION['actif'])) { // (sinon cela veut dire que l'on a cliqué sur une ville). Si on a pas de ville cliqué en mémoire
                $this->vue->commenceJeu($_SESSION['villes'], $mmLigne); // on affiche le jeu. $mmLigne = boolean qui definit si il y le message d'erreur ou non
                $_SESSION['actif'] = $_POST["villeId"]; //on sauvegarde la ville cliquée en variable de session
            } else {
                // On verifie si les deux villes sont liables
                if ($this->villes->liable($this->villes->findVilleById($_SESSION['actif'])[0], $this->villes->findVilleById($_SESSION['actif'])[1], $this->villes->findVilleById($_POST['villeId'])[0], $this->villes->findVilleById($_POST['villeId'])[1], $_SESSION['villes'])) {
                    $perdu = $_SESSION['villes']->perdu($_SESSION['villes']->getVilleById($_SESSION['actif']), $_SESSION['villes']->getVilleById($_POST['villeId'])); // on definit la boolean perdu graçe à la méthode du modèle pour savoir si le nouveau lien respecte le nombre max
                    // On appelle lieVille sur les deux villes afin que leurs attribut villeLiees soient toutes deux mises a jour
                    $_SESSION['villes']->getVilleById($_SESSION['actif'])->lieVille($_SESSION['villes']->getVilleById($_POST['villeId']));
                } else {
                    $mmLigne = true; //true signifie que l'on essaye de lier deux villes qui ne sont ni sur la mm ligne ni sur la mm colonne, ont une ville entre elles ou ont un pont dans le sens inverse sur leur trajectoire
                }
                //on recupere le ratio des 3 meilleurs joueurs
                foreach ($this->modele->getTroisMeilleurJoueur() as $player) {
                    $ratios[] = $this->modele->stat($player[0]);
                }
                if ($_SESSION['villes']->gagne()) {
                    $this->vue->resultat(true, $this->modele->stat($_SESSION['pseudo']), $this->modele->getTroisMeilleurJoueur(), $ratios);
                    unset($_SESSION['villes']);
                    $this->modele->ajoutPartie($_SESSION['pseudo'], true);
                } else if ($perdu) {
                    $this->vue->resultat(false, $this->modele->stat($_SESSION['pseudo']), $this->modele->getTroisMeilleurJoueur(), $ratios);
                    unset($_SESSION['villes']);
                    $this->modele->ajoutPartie($_SESSION['pseudo'], false);
                } else {
                    $this->vue->commenceJeu($_SESSION['villes'], $mmLigne);
                }
                unset($_SESSION['actif']);
            }
        }
    }
}
