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
     * Donne le nombre de pont entre this et la ville en parametre
     * @param Ville $ville Ville liée avec this avec laquelle on veut compter le nombre de ponts
     * @return int Le nombre de ponts entre deux villes
     */
    function getNombrePontEntreVille(Ville $ville)
    {
        return $this->villesLiees[$ville->getId()];
    }

    /** Permet de donner un nombre de pont entre deux villes
     * POSTCONDITION : Le nombre de ponts doit être inférieur a 2 a la fin
     * @param Ville $ville Ville liée avec this a qui on donne un nombre de pont
     * @param $nbPont
     */
    function setNombrePontEntreVille(Ville $ville, $nbPont)
    {
        $this->villesLiees[$ville->getId()] = $nbPont;
    }

    /**
     * Methode permettant de lier les villes entre elles
     * precondition : les villes peuvent être liées
     * postcondition : nombre de ponts <= 2
     * @param $villeALier Ville que l'on doit lier avec this.
     */
    function lieVille(Ville $villeALier)
    {
        if ($this->getNombrePontEntreVille($villeALier) >= 2) {
            echo "Trop de ponts entre les deux villes";
        } else {
            // On change le nombre de ponts entre les deux villes pour les deux villes
            $this->setNombrePontEntreVille($villeALier, $this->getNombrePontEntreVille($villeALier) + 1);
        }
    }
}
