<?php

if (isset($_POST['num'])) {
$num = $_POST['num'];
    for ($i = 0; $i<count($num); $i++) {
        $n = $i+1;
        echo "<p> El numero $n es: $num[$i] </p>";
    } 
} else {
    echo <<<_END
    <html>
    <head>
        <title>Suma numeros</title>
    </head>
    <body>

    _END;

    for ($i = 1; $i<11; $i++) {
        echo <<<_END
        <form action="formularioDinamico.php" method="post">
        <label>Numero $i</label> <input type="text" name="num[]">
        <br><br>

        _END;
    }

    echo <<<_END
        <input type="submit">
        </form>
        </body>
    </html>

    _END;
}


?>