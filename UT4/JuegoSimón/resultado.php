<?php
session_start();

$correcta = $_SESSION['numAleatorio'] ?? '';
$jugada = $_POST['color0'] . $_POST['color1'] . $_POST['color2'] . $_POST['color3'];

$ganaste = ($correcta === $jugada);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>

    <?php if ($ganaste): ?>
        <h2>¡Ganaste!</h2>
    <?php else: ?>
        <h2>Perdiste</h2>
        <p>La combinación correcta era:</p>
        <?php
        for ($i = 0; $i < 4; $i++) {
            $c = $correcta[$i];
            echo "<img src='{$c}.png' height='150px'>";
        }
        ?>
        <p>Tu combinación fue:</p>
        <?php
        for ($i = 0; $i < 4; $i++) {
            $c = $jugada[$i];
            echo "<img src='{$c}.png' height='150px'>";
        }
        ?>
    <?php endif; ?>

    <br><br>
    <a href="inicio.php">Volver a jugar</a>
</body>
</html>
