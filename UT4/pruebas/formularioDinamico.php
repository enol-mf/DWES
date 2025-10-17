<?php

if (isset($_POST['num']) && isset($_POST['cajas'])) {
$cajas = $_POST['cajas'];
$num = $_POST['num'];
    for ($i = 0; $i<$cajas; $i++) {
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
    $cajas = $_POST['cajas'];
    for ($i = 0; $i<$cajas; $i++) {
        echo <<<_END
        <form action="formularioDinamico.php" method="post">
        <label>Numero $i</label> <input type="text" name="num[]">
        <br><br>
        <input type="hidden" name="cajas" value="<?php echo $cajas; ?>">

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