<?php
session_start();

$conexion = new mysqli("localhost:3307", "root", "", "bdsimon");
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos");
}

$usuario = $_SESSION['usuario'];
$clave = $_SESSION['clave']
$clave2 = $_SESSION['clave2']

if ()

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
        <label for="">Contraseña: </label><input type="text" name="clave" id=""><br><br>
        <label for="">Repetir Contraseña: </label><input type="text" name="clave2" id=""><br><br>
        <input type="submit" value="Crear">
    </form>
</body>
</html>