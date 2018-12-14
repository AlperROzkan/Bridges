<?php


class Ville
{
    // permet d'identifier de manière unique la ville
    private $id;
    private $nombrePontsMax;
    private $nombrePonts;
    /*
     * un tableau associatif qui stocke les villes qui sont reliées à la ville cible et le nombre de ponts qui les
     * relient (ce nombre de ponts doit être <=2)
     */
    private $villesLiees;

    /**
     * constructeur qui permet de valuer les 2 attributs de la classe
     * @param $id
     * @param $nombrePontsMax
     * @param $nombrePonts
     */
    function __construct($id, $nombrePontsMax, $nombrePonts)
    {
        $this->id = $id;
        $this->nombrePontsMax = $nombrePontsMax;
        $this->nombrePonts = $nombrePonts;
        $this->villesLiees = null;
    }

    /**
     * sélecteur qui retourne la valeur de l'attribut id
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * sélecteur qui retourne la valeur de l'attribut nombrePontsMax
     * @return mixed
     */
    function getNombrePontsMax()
    {
        return $this->nombrePontsMax;
    }

    /**
     * sélecteur qui retourne la valeur de l'attribut nombrePonts
     * @return mixed
     */
    function getNombrePonts()
    {
        return $this->nombrePonts;
    }

    /**
     * modifieur qui permet de valuer l'attribut nombrePonts
     * @param $nb
     */
    function setNombrePonts($nb)
    {
        $this->nombrePonts = $nb;
    }

    //il faut ici implémenter les méthodes qui permettent de lier des villes entre elles, ...


    /**
     * Retourne le tableau associatif des villes liees de this
     * @return $this->villesLiees
     */
    function getVillesLiees()
    {
        return $this->villesLiees;
    }

    /**
     * Methode qui permet d'ajouter un element a $this->villesLiees
     * @param $villeCible ville avec laquelle on fait un lien
     * @param $nombrePonts le nombre de ponts avec cette ville
     */
    function setVillesLiees(Ville $villeCible, $nombrePonts)
    {
        $this->villesLiees[$villeCible->getId()] = $nombrePonts;
        $this->nombrePonts++;
    }

    /**
     * Methode permettant de lier les villes entre elles
     * precondition : les villes peuvent être liées
     * postcondition : nombre de ponts <= 2, villesLiees mises a jour sur les deux villes
     * @param $villeALier Ville que l'on doit lier avec this.
     * @return int
     */
    function lieVille(Ville $villeALier)
    {
        // On regarde si les villes sont les mêmes
        if ($this->getId() != $villeALier->getId()) {
            // On regarde si il y a trop de liens entre les deux villes
            if ($this->villesLiees[$villeALier->getId()] >= 2) {
                // TODO : Indiquer au joueur qu'il a lié trop de ponts entre deux villes
                echo "Trop de ponts entre les deux villes"; //il me semble qu'ici il faut renvoyer une exception qui fait perdre
            } // On verifie aussi si le nombre de ponts max n'est pas dépassé pour les villes
            else if ($this->nombrePonts + 1 <= $this->getNombrePontsMax() && $villeALier->nombrePonts + 1 <= $villeALier->getNombrePontsMax()) {
                // On change le nombre de ponts entre les deux villes
                // $this->villesLiees[$villeALier->getId()] = $this->villesLiees[$villeALier->getId()] + 1;
                $this->setVillesLiees($villeALier, $this->villesLiees[$villeALier->getId()] + 1);
                //$villeALier->setVillesLiees($this, $villeALier->getVillesLiees($this->getId) + 1);
            } else {
                return 0;//il me semble qu'ici aussi il faut renvoyer une exception qui fait perdre
            }
        }
    }

}
