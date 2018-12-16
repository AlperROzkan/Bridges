<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Resultat</title>
    <link rel="stylesheet" type="text/css" href="../Bridges/vue/styles/jeu.css">
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
<h3>Vous avez un ratio partiesGagnées/partiesJouées de : <?php echo $ratio; ?></h3>
<br>
<br>
<h3>Top 3 des meilleurs joueurs selon le nombre total de parties gagnées :</h3>
<h4>
<?php
$i = 0; //compteur pour parcourir le ratio des meilleurs joueurs
foreach ($bestPlayers as $player) {
  echo "<br>".$player[0]." avec ".$player[1]." victoires et un ratio de ".$ratiosBestPlayers[$i]."<br>";
  $i++;
}
 ?>
</h4>
</body>
</html>
