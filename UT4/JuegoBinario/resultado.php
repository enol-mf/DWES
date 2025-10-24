<?php
session_start();

$binario = $_SESSION['numAleatorio'];
$respuesta = $_POST['respuesta'];

if (bindec($binario) == $respuesta) {
    echo "La respuesta es correcta";
} else {
    echo "La respueta no es correcta";
    echo "La respuesta correcta era:  ".bindec($binario);
}

?>