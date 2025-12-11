<?php
    session_start(); // Inicia la sesión para poder usar $_SESSION

    // Datos de conexión a la base de datos
    $dbsrv = "localhost:3307"; // Servidor de la base de datos con puerto
    $dbuser = "jugador";       // Usuario de la base de datos
    $dbpass = "";              // Contraseña del usuario
    $dbdb = "jeroglifico";     // Nombre de la base de datos
    $conex = "";                // Variable que almacenará la conexión

    // Conexión a la base de datos usando mysqli
    $conex = mysqli_connect($dbsrv, $dbuser, $dbpass, $dbdb);
    if ($conex->connect_error) { // Si hay error en la conexión
        die("Error de conexión a la base de datos"); // Mostrar mensaje y detener el script
    }

    // Comprobamos si se ha enviado el formulario con la solución
    if (isset($_POST['sol'])) {
        $sol = $_POST['sol']; // Guardamos la solución enviada en variable

        // Solo insertamos si la solución no está vacía
        if(!empty($sol)) {
            $usuario = $_SESSION['user']; // Usuario logueado
            $fecha = date("Y-m-d");       // Fecha actual en formato YYYY-MM-DD
            $hora = date("H:i:s");        // Hora actual en formato HH:MM:SS
            
            // Consulta SQL para insertar la respuesta en la tabla 'respuestas'
            $query = "INSERT INTO respuestas (fecha, login, hora, respuesta)
                    VALUES ('$fecha','$usuario','$hora','$sol')";

            // Ejecutamos la consulta e informamos si se guardó correctamente
            if (mysqli_query($conex, $query)) {
                echo "<p>Solución guardada correctamente</p>";
            } else {
                echo "<p>Error al guardar la solución</p>";
            }
        } else {
            // Mensaje si el usuario intenta enviar una solución vacía
            echo "<p>No se puede enviar una solución vacía</p>";
        }   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Bienvenida al usuario logueado -->
    <h1>Bienvenido, <?php echo $_SESSION['user'];?> !</h1>
    <img src="images/20240216.jpg" alt="" width="400px">
    <p>¡Todos hablablan de la fiesta de ayer!</p>

    <!-- Formulario para enviar solución -->
    <form action="inicio.php" method="post">
        <label for="">Solución: </label>
        <input type="text" name="sol"> <br>
        <button type="submit">Enviar</button>
    </form>

    <!-- Mensaje de error si la solución está vacía -->
    <?php 
    if (empty($sol)) {
        echo "No se puede enviar una solución vacía";
    }  
    ?>

    <br>
    <!-- Enlaces a otras secciones -->
    <a href="puntos.php">Ver puntos por jugador</a><br>
    <a href="resultado.php">Resultados del día</a>
</body>
</html>
