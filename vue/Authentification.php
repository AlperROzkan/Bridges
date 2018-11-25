<?php

/**
 * La classe Authenitification de Bridges
 * Elle permettra au joueur de s'identifier avec les données de joueurs.sql
 */
class Authenitification
{
  function demandeIdentification() {
    header("Content-type: text/html; charset=utf-8");

    ?>
    <html>
    <body>
      <br/>
      <form method="post" action="index.php">
        Pseudo : <input type="text" name="pseudo"/>
        <br/>
        Mot de Passe : <input type="password" name="motDePasse">
        <br/>
        <input type="submit" name="soumettre" value="envoyer">
      </form>
    </body>
  </html>
  <?php
  }
}
?>
