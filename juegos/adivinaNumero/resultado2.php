<?php
session_start();

$num = $_SESSION['num'];
$respuesta = $_POST['respuesta'];
$correcta = ($num % 2 === 0) ? 'par' : 'impar';

if ($respuesta === $correcta) {
    echo "<h1>¡Correcto!</h1>";
} else {
    echo "<h1>Incorrecto</h1>";
    echo "<p>La respuesta correcta era: $correcta</p>";
}
?>
<a href="juego2.php">Volver a jugar</a>
