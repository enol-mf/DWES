<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost:3307", "jugador", "", "jeroglifico");
if ($conexion->connect_error) {
    die("Error de conexión");
}

// Procesar login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $clave = $_POST['clave'];

    $result = $conexion->query("SELECT * FROM jugador WHERE login='$login' AND clave='$clave'");

    if ($result && $result->num_rows == 1) {
        echo "Login correcto. Bienvenido, $login";
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}

$conexion->close();
?>

<form method="POST">
    Usuario: <input type="text" name="login" required><br>
    Contraseña: <input type="password" name="clave" required><br>
    <input type="submit" value="Entrar">
</form>
