<?php
// cette classe ne doit pas être modifiée
require "Ville.php";

class Villes
{
    private $villes;

    function __construct()
    {
        // tableau représentatif d'un jeu qui servira à développer votre code
        $this->villes[0][0] = new Ville("0", 3, 0);
        $this->villes[0][6] = new Ville("1", 2, 0);
        $this->villes[3][0] = new Ville("2", 6, 0);
        $this->villes[3][5] = new Ville("3", 2, 0);
        $this->villes[5][1] = new Ville("4", 1, 0);
        $this->villes[5][6] = new Ville("5", 2, 0);
        $this->villes[6][0] = new Ville("6", 2, 0);
    }

    /**
     * sélecteur qui retourne la ville en position $i et $j
     * précondition: la ville en position $i et $j existe
     * @param $i
     * @param $j
     * @return mixed
     */
    function getVille($i, $j)
    {
        return $this->villes[$i][$j];
    }

    /**
     * modifieur qui value le nombre de ponts de la ville en position $i et $j;
     * précondition: la ville en position $i et $j existe
     * @param $i
     * @param $j
     * @param $nombrePonts
     */
    function setVille($i, $j, $nombrePonts)
    {
        $this->villes[$i][$j]->setNombrePonts($nombrePonts);
    }

    /**
     * permet de tester si la ville en position $i et $j existe
     * postcondition: vrai si la ville existe, faux sinon
     * @param $i
     * @param $j
     * @return bool
     */
    function existe($i, $j)
    {
        return isset($this->villes[$i][$j]);
    }

    //rajout d'éventuelles méthodes

    /**
     * Retourne un entier qui donne le maximum des abscisses des villes
     * @return int
     */
    function maxX() {

      return 6+1 ;
    }

    /**
     * Retourne un entier qui donne le maximum des ordonnées des villes
     * @return int
     */
    function maxY() {
        // TODO A ameliorer
        return 6+1;
    }

    function tmp(){
      $res = 0;
      while (isset($villes[$i][0])) {
        $res++;
      }

      return $res;
    }

}
