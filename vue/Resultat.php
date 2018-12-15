<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Resultat</title>
</head>
<body>
<h1>Bridges</h1>
<h2>Eliott ROBIN et Alper OZKAN -- Info 2 Groupe 3 </h2>
<h3>Ecran de resultat</h3>

<hr>

<?php
if ($gagne) {
    ?>
    <h2>Bravo, vous avez gagné.</h2>
    <?php
} else {
    ?>
    <h2>Oh non, vous avez perdu.</h2>
    <?php
}
?>
<form method="post" action="../Bridges/index.php">
  <!--Deconnexion-->
  <input type="submit" name="deco" value="Deconnexion">
  <!--Reset-->
  <input type="submit" name="reset" value="Reset">
</form>
<br>
Vous avez un ratio w/l de : <?php echo $ratio; ?>
<br>
Meilleurs joueurs :
<?php
foreach ($bestPlayers as $player) {
  var_dump($player);
  echo "<br>".$player[0];
}


 ?>
</body>
</html>
