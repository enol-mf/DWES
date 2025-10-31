<?php
session_start();
$combi = $_SESSION['numAleatorio'];
$dificultad = strlen($combi);

if (isset($_POST['color0'])) {
    $jugada = '';
    for ($i = 0; $i < $dificultad; $i++) {
        $jugada .= $_POST['color' . $i];
    }

    echo "<h1>Simón</h1>";

    if ($jugada === $combi) {
        echo "<h2>¡Ganaste!</h2>";
    } else {
        echo "<h2>Perdiste</h2>";
        echo "<p>La combinación correcta era:</p>";
        for ($i = 0; $i < $dificultad; $i++) {
            $c = $combi[$i];
            echo "<img src='{$c}.png' height='150px'>";
        }
        echo "<p>Tu combinación fue:</p>";
        for ($i = 0; $i < $dificultad; $i++) {
            $c = $jugada[$i];
            echo "<img src='{$c}.png' height='150px'>";
        }
    }

    echo '<br><br><a href="inicio2.php">Volver a jugar</a>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="jugar2.php" method="post">
        <h1>Simón</h1>
        <h2>Pulsa los botones en el orden correspondiente</h2>

        <?php
        for ($i = 0; $i < $dificultad; $i++) {
            echo "<img id='img{$i}' src='n.png' height='200px'>";
        }
        for ($i = 0; $i < $dificultad; $i++) {
            echo "<input type='hidden' name='color{$i}' id='color{$i}'>";
        }
        ?>

        <br>
        <div class="contenedor">
            <input type="button" value="ROJO" class="r" onclick="pintar(0)">
            <input type="button" value="AZUL" class="b" onclick="pintar(1)">
            <input type="button" value="AMARILLO" class="y" onclick="pintar(3)">
            <input type="button" value="VERDE" class="g" onclick="pintar(2)">
        </div>
        <br>
        <input type="submit" value="Enviar">
    </form>

    <script>
        let contador = 0;
        const dificultad = <?php echo $dificultad; ?>;
        function pintar(color) {
            if (contador < dificultad) {
                document.getElementById('img' + contador).src = color + '.png';
                document.getElementById('color' + contador).value = color;
                contador++;
            }
        }
    </script>
</body>
</html>
