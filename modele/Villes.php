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
     * Indique si il y a une ville entre les deux villes données en paramètres.
     * Il faudra faire attention a l'ordre des villes: le for ne sera pas le meme si la ville vient en premier ou en deuxieme place.
     * @param $iA : Abscisse d'une ville A
     * @param $jA : Ordonnée d'une ville A
     * @param $iB : Abscisse d'une ville B
     * @param $jB : Ordonnée d'une ville B
     * @return bool True si il y a une ville entre les deux villes, False si il n'y en a pas
     */
    private function entreDeuxVilles($iA, $jA, $iB, $jB)
    {
        // On réorganise afin que les points sont dans le bonne ordre et que la boucle for() pour les parcourir apres fonctionne bien
        if ($iA>$iB) {
            $tmp = $iA;
            $iA = $iB;
            $iB = $tmp;

            $tmp = $jA;
            $jA = $jB;
            $jB = $tmp;
        }

        if($jA>$jB) {
            $tmp = $iA;
            $iA = $iB;
            $iB = $tmp;

            $tmp = $jA;
            $jA = $jB;
            $jB = $tmp;
        }

        // Si les deux villes sont sur la même abscisse
        if ($iA == $iB && $jA != $jB) {
            // On parcourt la ligne jusqu'a la ville que l'on veut lier
            for ($j = $jA+1; $j < $jB-1; $j++) {
                // On regarde si il y a une ville sur le chemin
                if ($this->existe($iA, $j)) {
                    return true;
                }
            }
        } // Si les deux villes sont sur la même ordonnée
        elseif ($iA != $iB && $jA == $jB) {
            // On parcourt la colonne jusqu'a la ville que l'on veut lier
            for ($i = $iA+1; $i < $iB-1; $i++) {
                // On regarde si il y a une ville sur le chemin
                if ($this->existe($i, $jA)) {
                    return true;
                }
            }
        } else {
            return false;
        }
        return false;
    }

    /**
     * Previent si deux villes sont liables ou non
     * @param $iA : Abscisse d'une ville A
     * @param $jA : Ordonnée d'une ville A
     * @param $iB : Abscisse d'une ville B
     * @param $jB : Ordonnée d'une ville B
     * @return bool True si les deux villes sont liables, false sinon
     */
    function liable($iA, $jA, $iB, $jB)
    {
        // On regarde si les deux villes données existent
        if ($this->existe($iA, $jA) && $this->existe($iB, $jB)) {
            // On verifie si les villes sont dans les même lignes ou dans les mêmes colonnes, on regarde aussi si il y a une ville entre les deux
            if ((($iA == $iB && $jA != $jB) || ($iA != $iB && $jA == $jB)) && !$this->entreDeuxVilles($iA,$jA,$iB,$jB)) {
                return true;
            }
        } // Les deux deux villes ne peuvent pas être égales
        elseif ($iA == $iB && $jA == $jB) {
            return false;
        } // On renvoie false dans tout autre cas
        else {
            return false;
        }
    }

    /**
     * Retourne toutes les villes liees entre elles
     * @return array : tableau associatif pour lequel l'id d'une ville ammene a un autre tableau associatif qui contient toutes les villes liees a la ville cible
     */
    function getToutesVillesLiees()
    {
        // On parcourt toutes les elements de $this-villes
        foreach ($this->villes as $element) {
            // Une fois dedans on reparcourt les elements a l'interieur de ce tableau
            foreach ($element as $ville) {
                // On mets tous les ponts dans un tableau associatif
                $ponts[$ville->getId()] = $ville->getVillesLiees();
                // Pour voir toutes les villes en meme temps
                // var_dump($ville);
            }
        }
        return $ponts;
    }

    function getPonts(){
        $res = array();
        $liaisons = $this->getToutesVillesLiees();
        echo "liaisons : ";
        var_dump($liaisons);
        echo "<br>";

        for($l = 0; $l < sizeof($liaisons); $l++ ){
            $coord = $this->findVilleById($l);
            echo "coord : ";
            var_dump($coord);
            echo "<br>";

            $villesliees = array_keys($liaisons[$l]);
            /*echo "villesliees : ";
            var_dump($villesliees);
            echo "<br>";*/
            foreach ($villesliees as $ville) {
              $villeCoord = $this->findVilleById($ville);
              echo "villecoord : ";
              var_dump($villeCoord);
              echo "<br> villecoord 0 :";
              var_dump ($villecoord[0]);
              echo "<br>";
              if ($villecoord[0] == $coord[0]) {
                echo "meme ligne <br>";
              }
            }

        }
      return $res;
    }


    /**
     * Retourne un entier qui donne le maximum des abscisses des villes
     * @return int
     */
    function maxX()
    {
        // TODO A ameliorer
        return 6 + 1;
    }

    /**
     * Retourne un entier qui donne le maximum des ordonnées des villes
     * @return int
     */
    function maxY()
    {
        // TODO A ameliorer
        return 6 + 1;
    }

    /**
     * Donne une ville a partir de son id
     * @param $id : Id d'une ville
     * @return bool|Ville Renvoie false si il n'y a pas d'id correspondant a une ville, renvoie la ville sinon
     */
    function getVilleById($id)
    {
        for ($i = 0; $i < 7; $i++) {
            for ($j = 0; $j < 7; $j++) {
                if ($this->existe($i, $j) && $this->villes[$i][$j]->getId() == $id) {
                    return $this->villes[$i][$j];
                }
            }
        }
        return false;
    }

    /**
     * Renvoie coordonnées de la ville à partir de l'id en param
     * @param $id
     * @return array|bool un tableau contenant les coordonées de la ville si reussi, false sinon
     */
    function findVilleById($id)
    {
        for ($i = 0; $i < 7; $i++) {
            for ($j = 0; $j < 7; $j++) {
                if ($this->existe($i, $j) && $this->villes[$i][$j]->getId() == $id) {
                    return array($i, $j);
                }
            }
        }
        return false;
    }
}
