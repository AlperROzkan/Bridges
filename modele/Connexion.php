<?php

/**
 * Classe générale d'exception
 */
class BdExtension extends Exception
{
  // Message d'erreur
  private $messageErreur;

  public function __construct($messageErreur)
  {
    $this->messageErreur=$messageErreur;
  }

  public function afficher()
  {
    return $this->messageErreur;
  }

}

/**
 * Exception liée à un problème de connexion
 */
class ConnexionException extends BdExtension
{
}

/**
 * Exception lié à un problème d'accès à unetable
 */
class TableAccesException extends BdExtension
{
}

/**
 * Classe gérant tout ce qui est lié à la base de données
 */
class Modele
{
  private $connexion;

  // Constructeur
  function __construct()
  {
    try {
      $chaine="mysql:host=".HOST.";dbname=".BD;
      $this->connexion = new PDO($chaine, LOGIN,PASSWORD);
      $this->connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      $exception = new ConnexionException("Problème : Connexion à la base de données échouée");
      throw $exception;
    }
  }

  // Méthode qui nous déconnecte de la base
  public function deconnexion()
  {
    $this->connexion=null;
  }

  /*
  * Methode qui permet de récuperer les pseudos dans la table 'joueurs' de joueurs.sql
  * Utilise une requete classique
  * Pre-condition : Rien
  * Post-condition : Donne un tableau contenant les 'pseudo's des joueurs
  * Gestion Erreur : TableAccesException est lancée
  */
  public function getPseudos()
  {
    try {
      // Requete sur la base de donnée
      $requete=$this->connexion->query("SELECT pseudo FROM joueurs");

      // Boucle qui remplit le tableau de retour avec les pseudos
      while ($ligne=$requete->fetch()) {
        $resultat[]=$ligne['pseudo'];
      }

      return($resultat);

    } catch (TableAccesException $e) {

    }

  }

  /*
  * Methode qui permet de verifier qu'un pseudo existe dans la table joueurs
  * Utilise une requete préparée
  * Post-condition : vrai si le pseudo existe, faux sinon
  * Gestion d'erreurs : TableAccesException est lancé
  */
  public function pseudoExiste($pseudo)
  {
    // TODO: Ecrire cette fonction, setup la RPI et tester ce qui a été fait jusque la
  }

}
