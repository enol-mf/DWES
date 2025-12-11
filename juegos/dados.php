<?php
session_start();

/* ============================================================
   1. INICIALIZAR HISTORIAL
   ============================================================ */

if (!isset($_SESSION["historial"])) {
    $_SESSION["historial"] = [];
}

$mensaje = "";

/* ============================================================
   2. PROCESAR JUGADA
   ============================================================ */

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["jugar"])) {

    // Tirada del jugador (1 a 6)
    $jugador = rand(1, 6);

    // Tirada de la máquina
    $maquina = rand(1, 6);

    // Determinar resultado
    if ($jugador > $maquina) {
        $resultado = "¡Ganaste!";
    } elseif ($jugador < $maquina) {
        $resultado = "Perdiste...";
    } else {
        $resultado = "Empate.";
    }

    $mensaje = "Tú sacaste $jugador — La máquina sacó $maquina — $resultado";

    // Guardar en historial
    $_SESSION["historial"][] = $mensaje;
}

/* ============================================================
   3. REINICIAR JUEGO
   ============================================================ */

if (isset($_POST["reset"])) {
    session_destroy();
    header("Location: dados.php");
    exit();
}
?>

<!-- ============================================================
     4. INTERFAZ SIN ESTILOS
============================================================ -->

<h2>Juego de Dados</h2>

<form method="POST">
    <button name="jugar">Tirar el dado</button>
</form>

<br>

<?php if ($mensaje): ?>
    <p><strong><?php echo $mensaje; ?></strong></p>
<?php endif; ?>

<h3>Historial:</h3>

<?php
if (empty($_SESSION["historial"])) {
    echo "<p>Aún no hay tiradas.</p>";
} else {
    foreach ($_SESSION["historial"] as $linea) {
        echo "<p>$linea</p>";
    }
}
?>

<form method="POST">
    <button name="reset">Reiniciar todo</button>
</form>
