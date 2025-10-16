<?php

    if (isset($_POST['resultado'])) $resultado = $_POST['resultado'];
    else $resultado = "(Not entered)";

    $num1 = 0;
    $num2 = 0;  
    $resultado = $num1 + $num2;

    echo <<<_END
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="pruebaNums.php" method="post">

        <h2>Cliente</h2>
        <label>num1</label> <input type="text" name="num1">
        <br><br>
        <label>num2</label> <input type="text" name="num2">
        <br><br>
        <input type="submit" value="Sumar">
        </form>
        <p> El resultado es: $resultado </p>

    </body>
    </html>
    _END;


    

?>
