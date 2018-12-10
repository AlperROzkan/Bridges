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
     * Methode permettant de lier les villes entre elles
     * postcondition : nombre de ponts <= 2
     * @param $villeALier Ville que l'on doit lier avec this.
     */
    function lieVille(Ville $villeALier) {
        // Respect des instructions
        if (!$this->getNombrePonts()>2) {
            // TODO : Quelquechose d'élégant pour dire a l'utilisateur qu'il essaye de lier beaucoup trop de villes en même temps
        }
        else {
            $this->villesLiees[$this->getId()] = $villeALier->getId();
        }
    }
}
