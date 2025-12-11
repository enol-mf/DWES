<?php
session_start();

/* ============================================================
   1. INICIALIZAR JUEGO SI NO EXISTE
   ============================================================ */

if (!isset($_SESSION["palabra"])) {

    // Lista de palabras para elegir
    $lista = ["gato", "perro", "casa", "programar", "php", "sql"];

    // Elegimos una palabra aleatoria
    $_SESSION["palabra"] = $lista[array_rand($lista)];

    // Convertimos la palabra en array de letras
    $_SESSION["letras"] = str_split($_SESSION["palabra"]);

    // Crear array de letras descubiertas
    $_SESSION["descubiertas"] = array_fill(0, count($_SESSION["letras"]), "_");

    // Intentos permitidos
    $_SESSION["intentos"] = 6;

    // Letras ya usadas
    $_SESSION["usadas"] = [];
}

/* ============================================================
   2. PROCESAR LETRA ENVIADA POR EL USUARIO
   ============================================================ */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["letra"])) {

    $letra = strtolower($_POST["letra"]);

    // Evitar repetir letras
    if (!in_array($letra, $_SESSION["usadas"]) && ctype_alpha($letra) && strlen($letra) === 1) {

        // Añadimos la letra al registro de usadas
        $_SESSION["usadas"][] = $letra;

        // Verificar si la letra está en la palabra
        if (in_array($letra, $_SESSION["letras"])) {

            // Actualizar letras descubiertas
            foreach ($_SESSION["letras"] as $i => $l) {
                if ($l === $letra) {
                    $_SESSION["descubiertas"][$i] = $letra;
                }
            }

        } else {
            // Letra incorrecta -> restar intento
            $_SESSION["intentos"]--;
        }
    }
}

/* ============================================================
   3. COMPROBAR ESTADO DEL JUEGO
   ============================================================ */

$ganado = !in_array("_", $_SESSION["descubiertas"]);
$perdido = $_SESSION["intentos"] <= 0;

?>

<!-- ============================================================
     4. INTERFAZ MUY SIMPLE (SIN ESTILOS)
============================================================ -->

<h2>Ahorcado en PHP</h2>

<p>Palabra: <?php echo implode(" ", $_SESSION["descubiertas"]); ?></p>
<p>Intentos restantes: <?php echo $_SESSION["intentos"]; ?></p>
<p>Letras usadas: <?php echo implode(", ", $_SESSION["usadas"]); ?></p>

<?php if ($ganado): ?>

    <h3>¡Has ganado! La palabra era: <?php echo $_SESSION["palabra"]; ?></h3>
    <form method="post"><button name="reset">Jugar de nuevo</button></form>

<?php elseif ($perdido): ?>

    <h3>Has perdido... La palabra era: <?php echo $_SESSION["palabra"]; ?></h3>
    <form method="post"><button name="reset">Reintentar</button></form>

<?php else: ?>

    <!-- Formulario para ingresar letra -->
    <form method="POST">
        <label>Introduce una letra:</label>
        <input type="text" name="letra" maxlength="1" required>
        <button type="submit">Enviar</button>
    </form>

<?php endif; ?>


<?php
/* ============================================================
   5. REINICIAR JUEGO
   ============================================================ */
if (isset($_POST["reset"])) {
    session_destroy();
    header("Location: ahorcado.php");
    exit();
}
