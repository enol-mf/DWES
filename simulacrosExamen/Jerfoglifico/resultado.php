<?php
session_start();

// Conexion
$conexion = new mysqli("localhost:3307", "jugador", "", "jeroglifico");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
//
//  Obtener la fecha del sistema
$fecha = date("2022-05-05");
echo "<h2>Resultados del día: $fecha</h2>";
//

//  Sumar un punto a los jugadores que han acertado
$update_sql = "
    UPDATE jugador
    SET puntos = puntos + 1
    WHERE login IN (
        SELECT r.login
        FROM respuestas r
        JOIN solucion s 
        ON r.respuesta = s.solucion
        WHERE r.fecha = ?
    )
";
$stmt = $conexion->prepare($update_sql);
$stmt->bind_param("s", $fecha);
$stmt->execute();
$stmt->close();
//

// Listar jugadores que han acertado
$acertantes_sql = "
    SELECT r.login, r.hora
    FROM respuestas r
    JOIN solucion s 
    ON r.respuesta = s.solucion  
    WHERE r.fecha = '$fecha'
";
$result_acertantes = $conexion->query($acertantes_sql);
$num_acertantes = $result_acertantes->num_rows;

echo "<p>Número de jugadores que han acertado: $num_acertantes</p>";

echo "<h3>Jugadores acertantes:</h3>";
if ($num_acertantes > 0) {
    echo "<ul>";
    while ($row = $result_acertantes->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['login']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No hay acertantes todavía.</p>";
}
//

?>
