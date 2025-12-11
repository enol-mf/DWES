<?php
    session_start(); // Inicia la sesión, aunque aquí no se está usando directamente

    // Datos de conexión a la base de datos
    $dbsrv = "localhost:3307"; // Servidor con puerto
    $dbuser = "jugador";       // Usuario
    $dbpass = "";              // Contraseña
    $dbdb = "jeroglifico";     // Nombre de la base de datos
    $conex = "";                // Variable que guardará la conexión

    // Conexión a la base de datos usando mysqli
    $conex = mysqli_connect($dbsrv, $dbuser, $dbpass, $dbdb);
    if ($conex->connect_error) { // Si falla la conexión
        die("Error de conexión a la base de datos"); // Mostrar error y detener ejecución
    }

    // Fecha que se va a consultar
    // $fecha = date("Y-m-d"); // Para usar la fecha actual
    $fecha = date("2024-02-16"); // Aquí se fija una fecha específica para pruebas

    echo "<h1>". $fecha ."</h1>"; // Mostrar la fecha en pantalla

    // Consulta SQL para contar el número total de aciertos de esa fecha
    $query = "SELECT COUNT(*) AS total_aciertos
            FROM respuestas r
            JOIN solucion s ON r.respuesta = s.solucion AND r.fecha = s.fecha
            WHERE r.fecha = '$fecha'";

    $resultado = mysqli_query($conex, $query); // Ejecuta la consulta

    $row = mysqli_fetch_assoc($resultado); // Obtiene el resultado como array asociativo

    echo "Numero total de aciertos ".$row['total_aciertos']; // Muestra el total de aciertos

    // Consulta SQL para obtener el nombre y fecha de los jugadores que acertaron
    $query_acertaron = "
    SELECT j.nombre, r.fecha
    FROM respuestas r
    JOIN jugador j ON r.login = j.login
    JOIN solucion s ON r.respuesta = s.solucion AND r.fecha = s.fecha
    WHERE r.fecha = '$fecha'
    ";

    $result = mysqli_query($conex, $query_acertaron); // Ejecuta la consulta

    echo "<h3>Jugadores que acertaron:</h3>"; // Título para los acertantes
    while ($row = mysqli_fetch_assoc($result)) { // Recorre todos los resultados
        echo $row['nombre'] . " - " . $row['fecha'] . "<br>"; // Muestra nombre y fecha
    }

    // Consulta SQL para obtener los jugadores que fallaron
    $query_fallaron = "
    SELECT j.nombre, r.fecha, r.respuesta
    FROM respuestas r
    JOIN jugador j ON r.login = j.login
    LEFT JOIN solucion s ON r.respuesta = s.solucion AND r.fecha = s.fecha
    WHERE r.fecha = '$fecha' AND s.fecha IS NULL
    ";

    $result2 = mysqli_query($conex, $query_fallaron); // Ejecuta la consulta de los que fallaron

    echo "<h3>Jugadores que fallaron:</h3>"; // Título para los que fallaron
    while ($row = mysqli_fetch_assoc($result2)) { // Recorre todos los resultados
        echo $row['nombre'] . " - " . $row['fecha'] . " (Respuesta: " . $row['respuesta'] . ")<br>"; 
        // Muestra nombre, fecha y la respuesta incorrecta
    }

    // Comentado: Consulta para actualizar puntos automáticamente (requiere permisos de update)
    // $update = "
    // UPDATE jugador j
    // JOIN respuestas r ON j.login = r.login
    // JOIN solucion s ON r.fecha = s.fecha AND r.respuesta = s.solucion
    // SET j.puntos = j.puntos + 1
    // WHERE r.fecha = CURDATE();
    // ";
    // mysqli_query($conex, $update); // Ejecutaría el update

?>
