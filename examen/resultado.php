<?php

    session_start();
    require_once('conexion.php');

    echo "<h1>Bienvenid@ " .$_SESSION["login"] ." </h1>";

    $query = "SELECT nombre, puntos, extra FROM jugador";
    $result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Puntos de jugadores</title>
</head>
<body>
    <h1>Puntos por jugador</h1> 

    <table border="1">
        <tr>
            <th>Nombre</th> 
            <th>Puntos</th>
            <th>Extra</th> 
        </tr>
        <?php
        if ($result && mysqli_num_rows($result) > 0) { 
            while ($row = mysqli_fetch_assoc($result)) { 
                echo "<tr>";
                echo "<td>" . $row['nombre'] . "</td>"; 
                echo "<td>" . $row['puntos'] . "</td>";
                echo "<td>" . $row['extra'] . "</td>";  
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay jugadores registrados</td></tr>";
        }
        ?>
    </table>
</body>
</html>