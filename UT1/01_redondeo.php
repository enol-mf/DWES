<?php
    $valor_redondear = 50.525;
            
    echo "El primero numero con redondeo para arriba " . round(num: $valor_redondear, mode: PHP_ROUND_HALF_UP) . ".<br>";
    echo "El segundo numero con redondeo para abajo " . round(num: $valor_redondear, mode: PHP_ROUND_HALF_DOWN) . ".<br>";
    echo "El primero numero con redondeo para el numero par " . round(num: $valor_redondear, mode: PHP_ROUND_HALF_ODD) . ".<br>";

?>