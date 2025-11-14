<?php
session_start();

$conexion = new mysqli("localhost:3307", "root", "", "bdsimon");
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];

    $sql = "SELECT * FROM usuarios WHERE Nombre='$nombre' AND Clave='$clave'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $_SESSION['nombre'] = $row['Nombre']; //  Guardamos el nombre del usuario
        header("Location: inicio3.php");
        exit();
    } else {
        echo "Usuario o clave incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Simón</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form method="post">
        <label>Usuario:</label>
        <input type="text" name="nombre" required><br><br>
        <label>Clave:</label>
        <input type="password" name="clave" required><br><br>
        <input type="submit" value="Entrar"> <br><br>
    </form>
    <form action="registro2.php" method="post">
        <input type="submit" value="Crear cuenta">
    </form>
</body>
</html> 
