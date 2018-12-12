<?php

/**
 * Created by IntelliJ IDEA.
 * User: OZKAN
 * Date: 12/12/2018
 * Time: 20:52
 */
require_once PATH_VUE . "/vue.php";
require_once PATH_MODELE . "/Modele.php";
require_once PATH_MODELE . "/Villes.php";


/**
 * Class ControleurVille
 * Permet de faire le lien entre les villes et la vue
 */
class ControleurVille
{
    private $vue;
    private $modele;
    private $villes;

    /**
     * ControleurVille constructor.
     * @param $vue
     * @param $modele
     * @param $villes
     */
    public function __construct($vue, $modele, $villes)
    {
        $this->vue = $vue;
        $this->modele = $modele;
        $this->villes = $villes;
    }


}