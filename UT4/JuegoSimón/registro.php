<?php
session_start();

$conexion = new mysqli("localhost:3307", "root", "", "bdsimon");
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos");
}

if (isset($_POST['usuario']) && isset($_POST['clave']) && isset($_POST['clave2'])) {

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $clave2 = $_POST['clave2'];

    if ($clave !== $clave2) {
        echo "La contraseña no igual";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Usuario: </label><input type="text" name="usuario" id=""><br><br>
        <label for="">Contraseña: </label><input type="password" name="clave" id=""><br><br>
        <label for="">Repetir Contraseña: </label><input type="password" name="clave2" id=""><br><br>
        <input type="submit" value="Crear">
    </form>
</body>
</html>