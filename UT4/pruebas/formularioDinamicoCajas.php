<?php

if (isset($_POST['cajas'])) {
$cajas = $_POST['cajas'];

} else {
    echo <<<_END
    <html>
    <head>
        <title>Suma numeros</title>
    </head>
    <body>
    <form action="formularioDinamico.php" method="post">
    <label>Numero de cajas: </label> <input type="text" name="cajas">
    <br><br>
        <input type="submit">
        </form>
        </body>
    </html>

    _END;
}


?>