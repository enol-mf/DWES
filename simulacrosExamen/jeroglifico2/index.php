<?php

    $dbsrv = "localhost:3307";
    $dbuser = "jugador";
    $dbpass = "";
    $dbdb = "jeroglifico";
    $conex = "";

    $conex = mysqli_connect($dbsrv, $dbuser, $dbpass, $dbdb);
    if ($conex->connect_error) {
    die("Error de conexión a la base de datos");
    }

    if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

    $query = "SELECT * FROM jugador WHERE login = '$user'  AND clave = '$pass'";




    } else {
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