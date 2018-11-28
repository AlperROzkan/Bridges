<?php

class Vue{

function demandePseudo(){
    header("Content-type: text/html; charset=utf-8");
?>
    <html>
    <body>
    <br/>
    <br/>
    <form method="post" action="index.php">
    Entrer votre pseudo  <input type="text" name="pseudo"/>
    </br>
    </br>
    <input type="submit" name="soumettre" value="envoyer"/>
    </form>
    <br/>
    <br/>
<?php
}
?>
