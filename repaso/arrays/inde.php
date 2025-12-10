<?php 

    $foods = array("apple","orange","banana","coconut","pera");

    // $foods[0] = "pineapple";

    array_push($foods, "pineapple","kiwi");
    // array_pop($foods); Borra el ultimo
    // array_shift($foods); Borra el primero
    // $foods = array_reverse($foods); Le da la vuelta
    echo count($foods)."<br>";
    // echo $foods[0]."<br>";
    // echo $foods[1]."<br>";
    // echo $foods[2]."<br>";
    // echo $foods[3]."<br>";

    foreach($foods as $food){
        echo $food. "<br>";
    }

?>