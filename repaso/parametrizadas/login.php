<?php
// Iniciar la sesión para poder guardar datos del usuario si el login es correcto
session_start();

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recoger datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // ---------- CONEXIÓN A BASE DE DATOS ----------
    // Ajusta los valores para tu servidor MySQL
    $host = "localhost";
    $db   = "mi_base";
    $user = "root";
    $pass = "";

    // Crear conexión con MySQLi
    $conn = new mysqli($host, $user, $pass, $db);

    // Ver si hubo error en la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // ---------- CONSULTA PARAMETRIZADA ----------
    // La consulta busca el usuario por nombre
    $sql = "SELECT id, username, password_hash FROM usuarios WHERE username = ?";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);

    // Vincular parámetros (s = string)
    $stmt->bind_param("s", $username);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener resultados
    $resultado = $stmt->get_result();

    // Verificar si existe el usuario
    if ($resultado->num_rows === 1) {

        // Obtener datos del usuario
        $fila = $resultado->fetch_assoc();

        // Verificar contraseña usando password_verify()
        if (password_verify($password, $fila["password_hash"])) {

            // Guardar datos en sesión
            $_SESSION["usuario_id"] = $fila["id"];
            $_SESSION["usuario"] = $fila["username"];

            echo "Login correcto. ¡Bienvenido, " . $fila["username"] . "!";
        } else {
            echo "Contraseña incorrecta.";
        }

    } else {
        echo "El usuario no existe.";
    }

    // Cerrar conexión
    $stmt->close();
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

    <button type="submit">Iniciar sesión</button>
</form>
