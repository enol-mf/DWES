<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$conexion = new mysqli("localhost:3307", "jugador", "", "jeroglifico");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

//  Obtener la fecha del sistema
$fecha = date("2022-05-05");
echo "<h2>Resultados del día: $fecha</h2>";

//  Sumar un punto a los jugadores que han acertado
$update_sql = "
    UPDATE jugador
    SET puntos = puntos + 1
    WHERE login IN (
        SELECT r.login
        FROM respuestas r
        JOIN solucion s 
        ON r.respuesta COLLATE utf8_spanish_ci = s.solucion COLLATE utf8_spanish_ci
        WHERE r.fecha = '$fecha'
    )
";
$conexion->query($update_sql);

// Listar jugadores que han acertado
$acertantes_sql = "
    SELECT r.login, r.hora
    FROM respuestas r
    JOIN solucion s 
    ON r.respuesta COLLATE utf8_spanish_ci = s.solucion COLLATE utf8_spanish_ci
    WHERE r.fecha = '$fecha'
";
$result_acertantes = $conexion->query($acertantes_sql);
$num_acertantes = $result_acertantes->num_rows;

echo "<p>Número de jugadores que han acertado: $num_acertantes</p>";

echo "<h3>Jugadores acertantes:</h3>";
if ($num_acertantes > 0) {
    echo "<ul>";
    while ($row = $result_acertantes->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['login']) . " - " . $row['hora'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No hay acertantes todavía.</p>";
}

?>
