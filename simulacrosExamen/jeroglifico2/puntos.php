<?php
session_start(); // Inicia la sesión para poder usar $_SESSION

// Verificar que el usuario está logueado
if (!isset($_SESSION['user'])) { // Si no hay sesión activa
    header("Location: index.php"); // Redirige al login
    exit(); // Detiene la ejecución del script
}

// Conexión a la base de datos
$dbsrv = "localhost:3307"; // Servidor con puerto
$dbuser = "jugador";       // Usuario
$dbpass = "";              // Contraseña
$dbdb   = "jeroglifico";   // Base de datos

$conex = mysqli_connect($dbsrv, $dbuser, $dbpass, $dbdb); // Crear conexión
if (!$conex) { // Si falla la conexión
    die("Error de conexión a la base de datos: " . mysqli_connect_error()); // Mostrar error
}

// Consulta para obtener todos los jugadores y sus puntos
$query = "SELECT nombre, puntos FROM jugador"; // SQL para traer nombre y puntos
$result = mysqli_query($conex, $query); // Ejecutar consulta
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Puntos de jugadores</title>
</head>
<body>
    <h1>Puntos de jugadores</h1>
    <p>Usuario logueado: <?php echo $_SESSION['user']; ?></p> <!-- Mostrar usuario actual -->

    <table border="1"> <!-- Tabla básica sin estilos -->
        <tr>
            <th>Nombre</th> <!-- Columna nombre -->
            <th>Puntos</th> <!-- Columna puntos -->
            <th>Gráfico</th> <!-- Columna para gráfico visual -->
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) { // Si hay resultados
            while ($row = mysqli_fetch_assoc($result)) { // Recorre cada jugador
                // Definir ancho del gráfico, por ejemplo 1px por punto
                $width = $row['puntos'] * 1; // Puedes ajustar el factor para hacerlo más grande
                echo "<tr>";
                echo "<td>" . $row['nombre'] . "</td>"; // Mostrar nombre
                echo "<td>" . $row['puntos'] . "</td>"; // Mostrar puntos
                // Mostrar div azul como "gráfico" proporcional a los puntos
                echo "<td><div style='background-color:blue; height:20px; width:{$width}px;'></div></td>";
                echo "</tr>";
            }
        } else { // Si no hay jugadores registrados
            echo "<tr><td colspan='3'>No hay jugadores registrados</td></tr>";
        }
        ?>
    </table>
</body>
</html>
