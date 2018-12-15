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
     * On ajoute un seul pont a chaque
     * @param $villeCible ville avec laquelle on fait un lien
     */
    function setVillesLiees(Ville $villeCible)
    {
        $this->villesLiees[$villeCible->getId()] = $this->villesLiees[$villeCible->getId()] + 1;
        $this->nombrePonts++;
    }

    /**
     * Methode permettant de lier les villes entre elles
     * precondition : les villes peuvent être liées
     * postcondition : nombre de ponts <= 2, villesLiees mises a jour sur les deux villes
     * @param $villeALier Ville que l'on doit lier avec this.
     */
    function lieVille(Ville $villeALier)
    {
        // On regarde si les villes sont les mêmes et si il y a trop de liens entre les deux villes
        if ($this->getId() != $villeALier->getId() && $this->villesLiees[$villeALier->getId()] < 2 && $this->nombrePonts + 1 <= $this->getNombrePontsMax() && $villeALier->nombrePonts + 1 <= $villeALier->getNombrePontsMax()) {
            // On change le nombre de ponts entre les deux villes
            $this->setVillesLiees($villeALier);
            $villeALier->setVillesLiees($this);
        } // Perdu reverifie si il y a trop de pont liés
    }

}
