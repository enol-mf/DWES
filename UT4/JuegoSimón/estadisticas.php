<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

$conexion = new mysqli("localhost:3307", "root", "", "bdsimon");
if ($conexion->connect_error) {
    die("Error de conexión");
}

$sql = "
    SELECT u.Codigo, u.Nombre, 
           COUNT(j.codjugada) AS total_jugadas,
           SUM(j.acierto) AS total_aciertos
    FROM usuarios u
    LEFT JOIN jugadas j ON u.Codigo = j.codigousu
    GROUP BY u.Codigo, u.Nombre
";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas de Jugadores</title>
    <style>
        body { font-family: Arial, sans-serif; text-align:center; }
        table { margin:auto; border-collapse: collapse; width: 70%; }
        th, td { border: 1px solid #555; padding: 10px; text-align: center; }
        th { background-color: #333; color: white; }
        .barra { height: 20px; background-color: #4CAF50; }
        a { display:inline-block; margin-top:20px; text-decoration:none; color:blue; }
    </style>
</head>
<body>
    <h1> Estadísticas de Jugadores</h1>
    <table>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Total Jugadas</th>
            <th>Aciertos</th>
            <th>Gráfico</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()): 
            $porcentaje = ($fila['total_jugadas'] > 0) ? 
                          ($fila['total_aciertos'] / $fila['total_jugadas']) * 100 : 0;
        ?>
        <tr>
            <td><?= $fila['Codigo'] ?></td>
            <td><?= htmlspecialchars($fila['Nombre']) ?></td>
            <td><?= $fila['total_jugadas'] ?></td>
            <td><?= $fila['total_aciertos'] ?></td>
            <td>
                <div style="width:100%; background:#ddd;">
                    <div class="barra" style="width:<?= $porcentaje ?>%"></div>
                </div>
                <?= round($porcentaje, 1) ?>%
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="inicio3.php">⬅ Volver al juego</a>
</body>
</html>
