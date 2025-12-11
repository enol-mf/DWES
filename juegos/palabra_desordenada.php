<?php
session_start();

/* ============================================================
   1. INICIALIZAR JUEGO SI NO EXISTE
   ============================================================ */

if (!isset($_SESSION["palabra"])) {

    // Lista de palabras
    $lista = ["perro", "gato", "programa", "teclado", "php", "juego", "coche"];

    // Elegir palabra aleatoria
    $palabra = $lista[array_rand($lista)];

    // Guardar palabra original
    $_SESSION["palabra"] = $palabra;

    // Desordenarla (mezclar letras)
    $letras = str_split($palabra);
    shuffle($letras);
    $_SESSION["desordenada"] = implode("", $letras);

    // Intentos
    $_SESSION["intentos"] = 5;

    // Historial
    $_SESSION["historial"] = [];
}

$mensaje = "";
$ganado = false;

/* ============================================================
   2. PROCESAR INTENTO DEL USUARIO
   ============================================================ */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["respuesta"])) {

    $respuesta = strtolower(trim($_POST["respuesta"]));

    // Registrar intento
    $_SESSION["historial"][] = $respuesta;

    // Verificar respuesta
    if ($respuesta === $_SESSION["palabra"]) {
        $mensaje = "¡Correcto! La palabra era: " . $_SESSION["palabra"];
        $ganado = true;
    } else {
        $_SESSION["intentos"]--;
        $mensaje = "Incorrecto. Te quedan " . $_SESSION["intentos"] . " intentos.";
    }

    // Si no quedan intentos
    if ($_SESSION["intentos"] <= 0 && !$ganado) {
        $mensaje = "Has perdido... La palabra era: " . $_SESSION["palabra"];
    }
}

/* ============================================================
   3. REINICIAR JUEGO
   ============================================================ */

if (isset($_POST["reset"])) {
    session_destroy();
    header("Location: palabra_desordenada.php");
    exit();
}
?>

<!-- ============================================================
     4. INTERFAZ SIN ESTILOS
============================================================ -->

<h2>Juego: Adivina la palabra desordenada</h2>

<p><strong>Palabra desordenada:</strong> <?php echo $_SESSION["desordenada"]; ?></p>
<p><strong>Intentos restantes:</strong> <?php echo $_SESSION["intentos"]; ?></p>

<?php if ($mensaje): ?>
    <p><strong><?php echo $mensaje; ?></strong></p>
<?php endif; ?>

<?php if (!isset($ganado) && $_SESSION["intentos"] > 0): ?>
    <form method="POST">
        <label>Tu respuesta:</label>
        <input type="text" name="respuesta" required>
        <button type="submit">Enviar</button>
    </form>
<?php else: ?>
    <form method="POST">
        <button name="reset">Jugar de nuevo</button>
    </form>
<?php endif; ?>

<h3>Intentos realizados:</h3>
<?php
if (empty($_SESSION["historial"])) {
    echo "<p>Ningún intento aún.</p>";
} else {
    foreach ($_SESSION["historial"] as $intento) {
        echo "<p>$intento</p>";
    }
}
?>
