<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$conexion = new mysqli("localhost:3307", "jugador", "", "jeroglifico");

$resultado = $conexion->query("SELECT login, puntos FROM jugador");
?>

<h3>Puntos por jugador</h3>

<table border="1" cellpadding="5">
<tr>
    <th>Jugador</th>
    <th>Puntos</th>
    <th>Gráfico</th>
</tr>

<?php
while ($fila = $resultado->fetch_assoc()) {
    $login = $fila["login"];
    $puntos = $fila["puntos"];

    $ancho = $puntos * 3;

    if ($ancho > 300) {
        $ancho = 300;
    }

    echo "<tr>";
    echo "<td>$login</td>";
    echo "<td>$puntos</td>";
    echo "<td>
            <div style='background:black; height:15px; width:".$ancho."px;'></div>
          </td>";
    echo "</tr>";
}
?>
