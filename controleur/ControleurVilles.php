<?php
/**
 * Created by IntelliJ IDEA.
 * User: OZKAN
 * Date: 10/12/2018
 * Time: 19:14
 */
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/Modele.php";



class ControleurVilles
{
    private $vue;
    private $modele;

    /**
     * ControleurVilles constructor.
     * @param $vue
     * @param $modele
     */
    public function __construct($vue, $modele)
    {
        $this->vue = $vue;
        $this->modele = $modele;
    }


}