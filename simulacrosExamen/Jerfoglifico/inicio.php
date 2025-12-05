<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$conexion = new mysqli("localhost:3307", "jugador", "", "jeroglifico");

$usuario = $_SESSION['login'];
$fecha = date("Ymd"); 
$imagen = "images/20240216.jpg";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $solucion = $_POST["solucion"];
    $hora = date("H:i:s");

    $sql = "INSERT INTO respuestas (login, solucion, fecha, hora)
            VALUES ('$usuario', '$solucion', CURDATE(), '$hora')";
    $conexion->query($sql);

    echo "Respuesta guardada.<br><br>";
}
?>

Bienvenido: <?php echo $usuario; ?><br><br>

<img src="<?php echo $imagen; ?>" width="300"><br><br>

<form method="POST">
    Tu solución: <input type="text" name="solucion" required>
    <input type="submit" value="Enviar">
</form>

<br>
<a href="puntos.php">Ver puntos por jugador</a><br>
<a href="resultado.php">Resultados del día</a>
