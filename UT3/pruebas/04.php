<?php

    $nums = array(4,2,3,5,1);

    $gente = array("hola","adios","pepe","perro","gato");

    sort($nums);
    sort($gente);

    print_r($nums);
    echo "<br>";
    print_r($gente);
    echo "<br>";
    $frase = explode(' ',"Esto es una frase");
    print_r($frase);
?>