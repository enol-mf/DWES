<?php
session_start();

$conexion = new mysqli("localhost:3307", "root", "", "bdsimon");
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos");
}

if (!isset($_POST['usuario']) && !isset($_POST['clave']) && !isset($_POST['clave2'])) {
    $usuario = ($_POST['usuario']);
    $clave = ($_POST['clave']);
    $clave2 = ($_POST['clave2']);

    if ($clave !== $clave2) {
        echo "Las contraseñas no coinciden";
    } else {
        $consulta = $conexion->prepare("SELECT Codigo FROM usuarios WHERE Nombre = ?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado->num_rows > 0) {
            echo "El usuario ya existe";
        } else {
            $insert = $conexion->prepare("INSERT INTO usuarios (Nombre, Clave, Rol) VALUES (?, ?, 0)");
            $insert->bind_param("ss", $usuario, $clave);
            if ($insert->execute()) {
                echo "Usuario registrado correctamente";
            } else {
                echo "Error al registrar";
            }
        }
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
        <label>Usuario: </label><input type="text" name="usuario"><br><br>
        <label>Contraseña: </label><input type="password" name="clave"><br><br>
        <label>Repetir Contraseña: </label><input type="password" name="clave2"><br><br>
        <input type="submit" value="Crear">
    </form>
    <form action="login.php" method="post">
        <input type="submit" value="Volver al login">
    </form>
</body>
</html>
