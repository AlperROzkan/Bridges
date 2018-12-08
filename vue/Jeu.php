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
    <link rel="stylesheet" type="text/css" href="styles/jeu.css">
</head>

<body>

<h1>Bridges</h1>
<h2>Eliott ROBIN et Alper OZKAN -- Info 2 Groupe 3 </h2>

<hr>

<!-- Plateau de jeu -->
<table>
    <!-- Le titre du jeu -->
    <thead>
    <tr>
        <th colspan=<?php echo $colonnes?>>Bridges</th>
    </tr>
    </thead>

    <!-- La zone de jeu -->
    <tbody>
    <?php
    for ($i = 0; $i < $lignes; $i++) {
        ?>
        <tr>
            <?php
            for ($j = 0; $j < $colonnes; $j++) {
                ?>
                <td>Hello</td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
    </tbody>


</table>

</body>
</html>
