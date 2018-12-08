<?php


class Ville
{
    // permet d'identifier de manière unique la ville
    private $id;
    private $nombrePontsMax;
    private $nombrePonts;
    // un tableau associatif qui stocke les villes qui sont reliées à la ville cible et le nombre de ponts qui les relient (ce nombre de ponts doit être <=2)
    private $villesLiees;

    // constructeur qui permet de valuer les 2 attributs de la classe
    function __construct($id, $nombrePontsMax, $nombrePonts)
    {
        $this->id = $id;
        $this->nombrePontsMax = $nombrePontsMax;
        $this->nombrePonts = $nombrePonts;
        $this->villesLiees = null;
    }

    // sélecteur qui retourne la valeur de l'attribut id
    function getId()
    {
        return $this->id;
    }

    // sélecteur qui retourne la valeur de l'attribut nombrePontsMax
    function getNombrePontsMax()
    {
        return $this->nombrePontsMax;
    }

    // sélecteur qui retourne la valeur de l'attribut nombrePonts
    function getNombrePonts()
    {
        return $this->nombrePonts;
    }

    //modifieur qui permet de valuer l'attribut nombrePonts
    function setNombrePonts($nb)
    {
        $this->nombrePonts = $nb;
    }

    //il faut ici implémenter les méthodes qui permettent de lier des villes entre elles, ...

}
