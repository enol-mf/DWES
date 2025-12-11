<?php
    session_start(); // Inicia la sesión para poder usar variables de sesión

    // Datos de conexión a la base de datos
    $dbsrv = "localhost:3307"; // Servidor de la base de datos con puerto
    $dbuser = "jugador";       // Usuario de la base de datos
    $dbpass = "";              // Contraseña del usuario de la base de datos
    $dbdb = "jeroglifico";     // Nombre de la base de datos
    $conex = "";                // Variable que almacenará la conexión

    // Conexión a la base de datos usando mysqli
    $conex = mysqli_connect($dbsrv, $dbuser, $dbpass, $dbdb);
    if ($conex->connect_error) { // Si hay error en la conexión
        die("Error de conexión a la base de datos"); // Muestra mensaje y detiene el script
    }

    // Si se han enviado los datos del formulario (usuario y contraseña)
    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST['user']; // Guardamos el valor del input 'user' en variable
        $pass = $_POST['pass']; // Guardamos el valor del input 'pass' en variable

        // Se muestra de nuevo el formulario (innecesario en este caso pero está en el código)
        echo <<<_END
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <form action="index.php" method="post">
                    <label for="">Usuario: </label>
                    <input type="text" name="user"><br>
                    <label for="">Contraseña: </label>
                    <input type="password" name="pass"><br>
                    <button type="submit">Entrar</button>
                </form>
            </body>
            </html>
        _END;

        // Consulta SQL para comprobar si el usuario y contraseña existen en la tabla 'jugador'
        $query = "SELECT * FROM jugador WHERE login = '$user'  AND clave = '$pass'";
        $resultado = mysqli_query($conex, $query); // Ejecutamos la consulta

        // Comprobamos si hay exactamente un resultado (usuario válido)
        if($resultado && mysqli_num_rows($resultado)===1) {
            $fila = mysqli_fetch_assoc($resultado); // Obtenemos los datos del usuario

            $_SESSION['user'] = $fila['login']; // Guardamos el login en la sesión

            header("Location: inicio.php"); // Redirigimos al usuario a la página de inicio
        } else {
            echo "contraseña incorrecta"; // Mensaje si usuario o contraseña no coinciden
        }

    } else {
        // Si no se han enviado datos del formulario, mostramos el formulario de login
        echo <<<_END
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <form action="index.php" method="post">
                    <label for="">Usuario: </label>
                    <input type="text" name="user"><br>
                    <label for="">Contraseña: </label>
                    <input type="password" name="pass"><br>
                    <button type="submit">Entrar</button>
                </form>
            </body>
            </html>
        _END;
    }

?>
