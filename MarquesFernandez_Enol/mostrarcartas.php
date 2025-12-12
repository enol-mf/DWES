<?php

    session_start();
    $cartasLevantadas = 0;
    echo "<h1>Bienvenid@ " .$_SESSION["login"] ." </h1>";
    echo <<<_END
    <h2>Cartas levantadas: </h2> <h2>$cartasLevantadas</h2>
    _END;
    
    for ($i = 0; $i < 6; $i++) {
        $numAleatorio[$i] = rand(0, 5);
    }

    // for ($i = 0; $i < 6; $i++) {
    //     $numAleatorio[$i] = rand(0, 5);
    //     for ($j = 0; $j < $i; $j++) {
    //         if ($numAleatorio[$i] == $numAleatorio[$j]) {
    //             $numAleatorio[$i] = rand(0, 5);
    //         }
    //     }
    // }

    $_SESSION['numAleatorio'] = implode('', $numAleatorio);

    echo <<<_END
        <form action="resultado.php" method="post">
            <button type="submit">Comprobar</button>
        </form>
    _END;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        for ($i = 1; $i<7; $i++) {
            echo <<<_END
            <button name="carta$i"> Levantar carta $i </button>
            _END;
        }
        echo "<br>";
        for ($i = 0; $i<6; $i++) {
            echo <<<_END
               <img src="$numAleatorio[$i].jpg" height="200px" width="140px">
            _END;
        }
        echo "<br>";    
        for ($i = 0; $i<6; $i++) {
            echo <<<_END
               <img src="boca_abajo.jpg" height="200px" width="140px">
            _END;
        }
?>
</body>
</html>

