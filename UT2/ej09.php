<?php

// 9. Escriba un programa a partir de un número entero generado de forma aleatoria
// indique si es primo. Un número primo es aquel que es divisible por el mismo y la
// unidad.

$numero = rand(min: 1,max: 20);
$esPrimo = true;

if ($numero <= 1) {
    $esPrimo = false;
} else {
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            $esPrimo = false;
            break;
        }
    }
}

echo "Número generado: $numero\n";
echo $esPrimo ? "Es primo" : "No es primo";

?>