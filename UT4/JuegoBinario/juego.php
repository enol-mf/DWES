<?php

$numAleatorio = [];

for ($i = 0; $i < 4; $i++) {
    $numAleatorio[$i] = rand(0, 1);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <h1>Adivina el número binario!</h1>

    <label for="">Número en binario: </label> <p>

    <?php

    for ($i = 0; $i < 4; $i++) {
        echo $numAleatorio[$i];
    }
?>
    </p>
    <br>

    <?php
        for ($i = 0; $i<4; $i++) {
            if ($numAleatorio[$i] == 1) {
               echo <<<_END
               <img src="$i.JPG" height="150px">
               _END;
            } else {
                echo <<<_END
               <img src="n.JPG" height="150px">
               _END;
            }
        }
    ?>


    <br>
    <label for="">Número decimal: </label> <input type="text" class="respuesta" name="respuesta">
</body>
</html>




