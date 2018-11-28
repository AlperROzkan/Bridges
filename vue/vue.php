<?php

class Vue{

function demandePseudo(){
   
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
}
?>