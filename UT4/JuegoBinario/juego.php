<?php
session_start();
$numAleatorio = [];

for ($i = 0; $i < 4; $i++) {
    $numAleatorio[$i] = rand(0, 1);
}

$_SESSION['numAleatorio'] = implode('', $numAleatorio);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Adivina el número binario!</h1>
<form action="resultado.php" method="post">
    <lab el for="">Número en binario: </label> <p>

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
        <br>
        <input type="submit">
    </form>

</body>
</html>




