<?php
$conexion = new mysqli("localhost:3307", "jugador", "", "jeroglifico");
if ($conexion->connect_error) {
    die("Error de conexión");
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM jugador WHERE login='$login' AND clave='$clave'";
    $result = $conexion->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['login'] = $login;
        header("Location: inicio.php");
        exit;
    } else {
        echo "Usuario o contraseña incorrectos.<br><br>";
    }
}

$conexion->close();
?>

<form method="POST">
    Usuario: <input type="text" name="login" required><br>
    Contraseña: <input type="password" name="clave" required><br>
    <input type="submit" value="Entrar">
</form>
