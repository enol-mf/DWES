<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

$combi = $_SESSION['numAleatorio'];
$numColores = $_SESSION['numColores'];
$dificultad = strlen($combi);

if (isset($_POST['color0'])) {
    $jugada = '';
    for ($i = 0; $i < $dificultad; $i++) {
        $jugada .= $_POST['color' . $i];
    }

    echo "<h1>Simón</h1>";

    $conexion = new mysqli("localhost:3307", "root", "", "bdsimon");
    if ($conexion->connect_error) {
        die("Error de conexión");
    }

    $nombreUsu = $_SESSION['nombre'];
    $sqlUsuario = "SELECT Codigo FROM usuarios WHERE Nombre='$nombreUsu'";
    $resUsuario = $conexion->query($sqlUsuario);
    $row = $resUsuario->fetch_assoc();
    $codigoUsu = $row['Codigo'];

    $acierto = 0;
    if ($jugada === $combi) {
        echo "<h2>¡Ganaste!</h2>";
        $acierto = 1;
    } else {
        echo "<h2>Perdiste</h2>";
        echo "<p>La combinación correcta era:</p>";
        for ($i = 0; $i < $dificultad; $i++) {
            $c = $combi[$i];
            echo "<img src='{$c}.png' height='120px'>";
        }
        echo "<p>Tu combinación fue:</p>";
        for ($i = 0; $i < $dificultad; $i++) {
            $c = $jugada[$i];
            echo "<img src='{$c}.png' height='120px'>";
        }
    }

    $sqlInsert = "INSERT INTO jugadas (codigousu, acierto) VALUES ($codigoUsu, $acierto)";
    $conexion->query($sqlInsert);
    $conexion->close();

    echo '<br><br><a href="inicio3.php">Volver a jugar</a> | <a href="estadisticas.php">Ver estadísticas</a>';
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simón</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="jugar3.php" method="post">
        <h1>Simón</h1>
        <h2>Pulsa los botones en el orden correspondiente</h2>

        <?php
        for ($i = 0; $i < $dificultad; $i++) {
            echo "<img id='img{$i}' src='n.png' height='150px'>";
        }
        for ($i = 0; $i < $dificultad; $i++) {
            echo "<input type='hidden' name='color{$i}' id='color{$i}'>";
        }
        ?>

        <br><br>
        <div class="contenedor">
            <?php
            $nombresColores = [
                0 => 'ROJO',
                1 => 'AZUL',
                2 => 'VERDE',
                3 => 'AMARILLO',
                4 => 'MORADO',
                5 => 'AZUL VERDOSO',
                6 => 'MARRÓN',
                7 => 'NARANJA'
            ];
            $clases = ['r', 'b', 'g', 'y', 'p', 'c', 'm', 'o'];
            for ($i = 0; $i < $numColores; $i++) {
                echo "<input type='button' value='{$nombresColores[$i]}' class='{$clases[$i]}' onclick='pintar($i)'>";
            }
            ?>
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
