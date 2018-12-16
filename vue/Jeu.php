<?php
/**
 * Created by IntelliJ IDEA.
 * User: OZKAN
 * Date: 08/12/2018
 * Time: 09:19
 */
// Initialisation des variables pour le nombre de lignes et de colonnes
$lignes = $villes->maxX();
$colonnes = $villes->maxY();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bridges</title>
    <link rel="stylesheet" type="text/css" href="../Bridges/vue/styles/jeu.css">
</head>

<body>
<h1>Bridges</h1>
<h2>Eliott ROBIN et Alper OZKAN -- Info 2 Groupe 3 </h2>
<h3><?php echo(htmlentities("Bienvenue à vous, " . $_SESSION["pseudo"])); ?></h3>

<hr>

<form method="post" action="../Bridges/index.php">
    <!--Deconnexion-->
    <input type="submit" name="deco" value="Deconnexion">
    <!--Reset-->
    <input type="submit" name="reset" value="Reset">
</form>

<?php //Tests a enlever plus tard
    $villes->getToutesVillesLiees();

?>

<!-- Plateau de jeu -->
<table>
    <!-- Le titre du jeu -->
    <thead>
    <tr>
        <th colspan=<?php echo $colonnes ?>>Bridges</th>
    </tr>
    </thead>

    <form method="post" action="../Bridges/index.php">
      <?php
        if ($error) {
          echo "<p>Vous avez essayé de lier deux villes qui : <br>ne sont pas dans la même colonne ni dans la même ligne <br> ont une ville entre elles <br> ont un pont dans le sens inverse sur leur trajectoire </p>";
        }
       ?>
        <!-- La zone de jeu -->
        <tbody>
        <?php
        for ($i = 0; $i < $lignes; $i++) {
            ?>
            <tr>
                <?php
                for ($j = 0; $j < $colonnes; $j++) {
                    if ($villes->existe($i, $j)) {
                        ?>
                        <td><button type="submit" name="villeId" <?php echo "value=\"".$villes->getVille($i, $j)->getId()."\"";?>><img src="<?php echo "../Bridges/vue/img/".$villes->getVille($i, $j)->getNombrePontsMax().".png\""." name=\"villeId\""."value=\"".$villes->getVille($i, $j)->getId()."\"";?>" alt=""></button></td>
                        <?php
                    } else if (in_array(array($i,$j,"h1"), $villes->getPonts())) {
                        ?>
                        <td><input type="image" src="../Bridges/vue/img/h1.png" disabled></td>
                        <?php
                    } else if (in_array(array($i,$j,"v1"), $villes->getPonts())) {
                        ?>
                        <td><input type="image" src="../Bridges/vue/img/v1.png" disabled></td>
                        <?php
                    } else if (in_array(array($i,$j,"v2"), $villes->getPonts())) {
                        ?>
                        <td><input type="image" src="../Bridges/vue/img/v2.png" disabled></td>
                        <?php
                    } else if (in_array(array($i,$j,"h2"), $villes->getPonts())) {
                        ?>
                        <td><input type="image" src="../Bridges/vue/img/h2.png" disabled></td>
                        <?php
                    }

                    else {
                        ?>
                        <td><input type="image" src="../Bridges/vue/img/blanc.png" disabled></td>
                        <?php
                    }
                }
                ?>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </form>
</table>
</body>
</html>
