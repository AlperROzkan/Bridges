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
  function __construct() {
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
  public function deconnexion() {
    $this->connexion=null;
  }

  /*
  * Methode qui permet de récuperer les pseudos dans la table 'joueurs' de joueurs.sql
  * Utilise une requete classique
  * Pre-condition : Rien
  * Post-condition : Donne un tableau contenant les 'pseudo's des joueurs
  * Gestion Erreur : TableAccesException est lancée
  */
  public function getPseudos(){
   try{

  $statement=$this->connexion->query("SELECT pseudo from pseudonyme;");

  while($ligne=$statement->fetch()){
  $result[]=$ligne['pseudo'];
  }
  return($result);
  }
  catch(PDOException $e){
      throw new TableAccesException("problème avec la table pseudonyme");
    }
  }

  /*
  * Methode qui permet de verifier qu'un pseudo existe dans la table joueurs
  * Utilise une requete préparée
  * Post-condition : vrai si le pseudo existe, faux sinon
  * Gestion d'erreurs : TableAccesException est lancé
  */
  public function exists($pseudo){
try{
	$statement = $this->connexion->prepare("select id from pseudonyme where pseudo=?;");
	$statement->bindParam(1, $pseudoParam);
	$pseudoParam=$pseudo;
	$statement->execute();
	$result=$statement->fetch(PDO::FETCH_ASSOC);

	if ($result["id"]!=NUll){
	return true;
	}
	else{
	return false;
	}
}
catch(PDOException $e){
    $this->deconnexion();
    throw new TableAccesException("problème avec la table pseudonyme");
    }
}

}
