<?php
$gente = array(
    array(
        'Familia' => 'Los Simpson',
        'Padre' => 'Homer',
        'Madre' => 'Marge',
        'Hijos' => array('Bart', 'Lisa', 'Maggie')
    ),
    array(
        'Familia' => 'Los Griffin',
        'Padre' => 'Peter',
        'Madre' => 'Lois',
        'Hijos' => array('Chris', 'Meg', 'Stewie')
    )
);
echo "<ul>";
foreach ($gente as $indice => $familia) {
    foreach ($familia as $clave => $valor) {
        if (is_array($valor)) {

        echo "<li>";
            echo "$clave:<br>";
            foreach ($valor as $hijo) {
                echo "<li>";
                echo "- $hijo<br>";
                echo "</li>";
            }
        echo "</li>";
        } else {
            echo "<li>";
            echo "$clave: $valor<br>";
            echo "</ul>";
            echo "</li>";
        }
    }

   
    echo "<br>"; 

}
?>
