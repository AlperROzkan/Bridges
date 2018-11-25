<?php
require_once 'ControleurAuthentification.php';

/**
 * Classe qui route les requetes
 */
class Routeur
{

  function __construct()
  {
    $this->ControleurAuthentification = new ControleurAuthentification();
  }

  /**
  * Permet de diriger les requetes
  */
  public function routerRequete()
  {
    
  }
}

?>
