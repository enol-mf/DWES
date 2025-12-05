<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$conexion = new mysqli("localhost:3307", "jugador", "", "jeroglifico");

$fecha = date("Y-m-d");

// 1) Obtener solución correcta del día
$sol = $conexion->query("SELECT solucion FROM solucion WHERE fecha='$fecha'");
$correcta = ($sol->num_rows == 1) ? $sol->fetch_assoc()["solucion"] : "";

// 2) Obtener respuestas del día
$res = $conexion->query("SELECT * FROM respuestas WHERE fecha='$fecha'");

// contadores
$acertantes = [];
$fallos = [];

while ($fila = $res->fetch_assoc()) {
    if ($fila['solucion'] == $correcta) {
        $acertantes[] = $fila;
    } else {
        $fallos[] = $fila;
    }
}

// 3) Sumar puntos a acertantes
foreach ($acertantes as $a) {
    $login = $a['login'];
    $conexion->query("UPDATE jugador SET puntos = puntos + 1 WHERE login='$login'");
}
?>

Fecha de hoy: <?php echo $fecha; ?><br><br>

Acertantes: <?php echo count($acertantes); ?><br>
Fallos: <?php echo count($fallos); ?><br><br>

<b>Listado de acertantes</b><br>
<?php
foreach ($acertantes as $a) {
    echo $a['login'] . " a las " . $a['hora'] . "<br>";
}
?>

<br><b>Listado de fallos</b><br>
<?php
foreach ($fallos as $f) {
    echo $f['login'] . " a las " . $f['hora'] . "<br>";
}
?>
