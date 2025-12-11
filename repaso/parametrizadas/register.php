<?php
// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recoger datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // ---------- VALIDACIONES BÁSICAS ----------
    if (strlen($username) < 3) {
        die("El nombre de usuario es demasiado corto.");
    }

    if (strlen($password) < 4) {
        die("La contraseña es demasiado corta.");
    }

    // ---------- CONEXIÓN A BASE DE DATOS ----------
    // Ajusta estos valores a tu servidor MySQL
    $host = "localhost";
    $db   = "mi_base";
    $user = "root";
    $pass = "";

    // Crear conexión
    $conn = new mysqli($host, $user, $pass, $db);

    // Verificar errores en la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // ---------- VERIFICAR SI EL USUARIO YA EXISTE ----------
    $sql_check = "SELECT id FROM usuarios WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $resultado = $stmt_check->get_result();

    if ($resultado->num_rows > 0) {
        die("El usuario ya existe, elige otro nombre.");
    }

    $stmt_check->close();

    // ---------- INSERTAR NUEVO USUARIO ----------
    // Crear un hash seguro de la contraseña
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql_insert = "INSERT INTO usuarios (username, password_hash) VALUES (?, ?)";

    // Preparar sentencia
    $stmt_insert = $conn->prepare($sql_insert);

    // Vincular parámetros (s = string)
    $stmt_insert->bind_param("ss", $username, $password_hash);

    // Ejecutar el INSERT
    if ($stmt_insert->execute()) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar: " . $conn->error;
    }

    // Cerrar conexiones
    $stmt_insert->close();
    $conn->close();
}
?>

<!-- FORMULARIO HTML SIN ESTILOS -->
<form method="POST" action="">
    <label>Usuario:</label>
    <input type="text" name="username" required>

    <br><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <br><br>

    <button type="submit">Registrarse</button>
</form>
