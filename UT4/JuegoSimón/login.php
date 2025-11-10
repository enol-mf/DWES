<?php
$conexion = new mysqli("localhost:3307", "root", "", "bdsimon");
if ($conexion->connect_error) {
    die("Error de conexión");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $sql = "SELECT * FROM usuarios WHERE Nombre='$nombre' AND Clave='$clave'";
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows > 0) {
        header("Location: inicio3.php");
        exit();
    } else {
        echo "Usuario o clave incorrectos";
    }
}
?>
<form method="post">
    Usuario: <input type="text" name="nombre"><br>
    Clave: <input type="password" name="clave"><br>
    <input type="submit" value="Entrar">
</form>
