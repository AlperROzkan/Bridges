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
        $this->messageErreur = $messageErreur;
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
    // On ajoute une variable idPartie afin de compter le nombre de parties
    private static $idPartie = 0;

    // Constructeur
    function __construct()
    {
        try {
            $chaine = "mysql:host=" . HOST . ";dbname=" . BD;
            $this->connexion = new PDO($chaine, LOGIN, PASSWORD);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            $exception = new ConnexionException("Problème : Connexion à la base de données échouée");
            throw $exception;
        }
    }

    // Méthode qui nous déconnecte de la base
    public function deconnexion()
    {
        $this->connexion = null;
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

            $statement = $this->connexion->query("SELECT pseudo from joueurs;");

            while ($ligne = $statement->fetch()) {
                $result[] = $ligne['pseudo'];
            }
            return ($result);
        } catch (PDOException $e) {
            throw new TableAccesException("problème avec la table joueurs");
        }
    }

    public function getMdp($pseudo)
    {
        try {

            $statement = $this->connexion->prepare("SELECT motDePasse from joueurs WHERE pseudo=?;");
            $statement->bindParam(1, $pseudo);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return ($result["motDePasse"]);
        } catch (PDOException $e) {
            throw new TableAccesException("problème avec la table joueurs");
        }
    }


    /*
    * Methode qui permet de verifier qu'un pseudo existe dans la table joueurs
    * Utilise une requete préparée
    * Post-condition : vrai si le pseudo existe, faux sinon
    * Gestion d'erreurs : TableAccesException est lancé
    */
    public function exists($pseudo)
    {
        try {
            $statement = $this->connexion->prepare("select pseudo from joueurs where pseudo=?;");
            $statement->bindParam(1, $pseudoParam);
            $pseudoParam = $pseudo;
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if ($result["pseudo"] != NUll) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $this->deconnexion();
            throw new TableAccesException("problème avec la table pseudonyme");
        }
    }

    /**
     * Ajoute une ligne dans la table partie
     * L'id s'incremente tout seul.
     * PRECONDITION : pseudo est un String, $etatPartie un booleen
     * POSTCONDITION : une ligne est ajoutée dans phpmyadmin
     * @param $pseudo : Le pseudo du joueur qui a joué la partie
     * @param $etatPartie : True si la partie est gagnée, False sinon
     */
    public function ajoutPartie($pseudo, $etatPartie)
    {
        // On incremente la partie de 1
        $this->idPartie++;
        try {
            // On insere les valeurs dans la table
            $statement = $this->connexion->prepare("INSERT INTO parties (id, pseudo, partieGagnee) VALUES (?,?,?);");
            $statement->bindParam(1, $this->idPartie);
            $statement->bindParam(2, $pseudo);
            $statement->bindParam(3, $etatPartie);
            $statement->execute();
        } catch (PDOException $e) {
            $this->deconnexion();
            throw new TableAccesException("Probleme avec la table parties");
        }


    }
}
