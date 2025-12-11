<?php
session_start();

$palabra = $_SESSION['palabra'];
$respuesta = strtolower($_POST['respuesta']);

if ($respuesta === $palabra) {
    echo "<h1>¡Correcto!</h1>";
} else {
    echo "<h1>Incorrecto</h1>";
    echo "<p>La palabra correcta era: $palabra</p>";
}
?>
<a href="juego1.php">Volver a jugar</a>
