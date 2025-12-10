<?php
    include("database.php");

    $username = "Arenita2.0";
    $password = "texas123";

    $connection = mysqli_connect($db_server,$db_user,$db_pass,$db_name); //esta linea la puse pa q no de errores, no es necesaria
    //pilla los datos del database.php

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (user, password)
            VALUES ('$username', '$hash')";

    try {
        mysqli_query($connection, $sql);
        echo"El usuario se registró correctamente";
    } catch(mysqli_sql_exception) {
        echo"No se pudo registrar el usuario";
    }

    mysqli_close($connection);
?>