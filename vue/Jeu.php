<?php
/**
 * Created by IntelliJ IDEA.
 * User: OZKAN
 * Date: 08/12/2018
 * Time: 09:19
 */
// Initialisation des variables
$lignes = 7;
$colonnes = 5;
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
    <!-- TODO : Tester plus en détail le fonctionnement de la deco, c'est un peu bricolé ce que j'ai fait-->
    <!--Deconnexion-->
    <input type="submit" value="Deconnexion">
</form>

<!-- Plateau de jeu -->
<table>
    <!-- Le titre du jeu -->
    <thead>
    <tr>
        <th colspan=<?php echo $colonnes?>>Bridges</th>
    </tr>
    </thead>

    <form method="post" action="">
        <!-- La zone de jeu -->
        <tbody>
        <?php
        for ($i = 0; $i < $lignes; $i++) {
            ?>
            <tr>
                <?php
                echo $bonjour;
                for ($j = 0; $j < $colonnes; $j++) {
                    ?>
                    <td><input type="image" src="../Bridges/vue/img/one.jpg" alt="submit"></td>
                    <?php
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
