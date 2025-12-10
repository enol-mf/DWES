<?php 

    $capitals = array("USA"=>"Washington DC",
                    "Japan"=>"Kyoto",
                    "South Korea"=>"Seoul",
                    "India"=>"New Delhi");

    $capitals["USA"]="Las Vegas";
    $capitals["China"]="Beijing"; //Añade al final del array
    // array_pop($capitals); //Borra el ultimo
    // array_shift($capitals); //Bora el primero
    // echo $capitals["USA"];
    // $keys = array_keys($capitals); //Crea un array nuevo con solo las keys
    // foreach($keys as $key) { //Ver todas las keys
    //     echo"{$key} <br>";
    // }
    // $values = array_values($capitals);
    // foreach($values as $value) { //Ver todas las keys
    //     echo"{$value} <br>";
    // }
    // $capitals = array_flip($capitals); //Cambia las keys por los values 

    foreach($capitals as $key=>$value) {
        echo"{$key} {$value} <br>";
    }

?>