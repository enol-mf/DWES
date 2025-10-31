 <?php
session_start();
$combi = $_SESSION['numAleatorio'];

if (isset($_POST['color0'])) {
    $jugada = $_POST['color0'] . $_POST['color1'] . $_POST['color2'] . $_POST['color3'];

    echo "<h1>Simón</h1>";

    if ($jugada === $combi) {
        echo "<h2>¡Ganaste!</h2>";
    } else {
        echo "<h2>Perdiste</h2>";
        echo "<p>La combinación correcta era:</p>";
        for ($i = 0; $i < 4; $i++) {
            $c = $combi[$i];
            echo "<img src='{$c}.png' height='150px'>";
        }
        echo "<p>Tu combinación fue:</p>";
        for ($i = 0; $i < 4; $i++) {
            $c = $jugada[$i];
            echo "<img src='{$c}.png' height='150px'>";
        }
    }

    echo '<br><br><a href="inicio.php">Volver a jugar</a>';
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
    <form action="jugar.php" method="post">
        <h1>Simón</h1>
        <h2>Pulsa los botones en el orden correspondiente</h2>

        <img id="img0" src="n.png" alt="" height="200px">
        <img id="img1" src="n.png" alt="" height="200px">
        <img id="img2" src="n.png" alt="" height="200px">
        <img id="img3" src="n.png" alt="" height="200px">

        <input type="hidden" name="color0" id="color0">
        <input type="hidden" name="color1" id="color1">
        <input type="hidden" name="color2" id="color2">
        <input type="hidden" name="color3" id="color3">

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

        function pintar(color) {
            if (contador < 4) {
                document.getElementById('img' + contador).src = color + '.png';
                document.getElementById('color' + contador).value = color;
                contador++;
            }
        }
    </script>
</body>
</html>
