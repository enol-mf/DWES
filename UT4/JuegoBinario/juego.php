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
    <div class="contenedor">
        <img src="8.JPG" alt="" height="150px">
        <img src="4.JPG" alt="" height="150px">
        <img src="2.JPG" alt="" height="150px">
        <img src="1.JPG" alt="" height="150px">
    </div>
    <br>
    <label for="">Número decimal: </label> <input type="text" class="respuesta">
</body>
</html>




