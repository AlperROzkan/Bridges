<?php
require_once PATH_VUE."/vue.php";
require_once PATH_MODELE."/Modele.php";

class ControleurAuthentification{

private $vue;
private $modele;

function __construct(){
$this->vue=new Vue();
$this->modele=new Modele();

}

function accueil(){
    if (!empty($_POST["pseudo"]) && $this->modele->exists($_POST["pseudo"]) && (crypt($_POST["mdp"], $this->modele->getMdp($_POST["pseudo"])) == $this->modele->getMdp($_POST["pseudo"]))){
        $this->vue->test();
        $_SESSION['pseudo'] = $_POST["pseudo"];
        
    } else {
        $this->vue->demandePseudo();
    }

}



}