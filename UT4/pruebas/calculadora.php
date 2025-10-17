<?php

    if (isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['ope'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $ope = $_POST['ope']; 
        
            if ($ope == "+") {
            $resul = $num1+$num2;
        } elseif ($ope == "-") {
            $resul = $num1-$num2;
        } elseif ($ope == "*") {
            $resul = $num1*$num2;
        } elseif ($ope == "/") {
            $resul = $num1/$num2;
        } else {
        echo "opcion no valida";
    }

        echo "<p> El resultado es: $resul </p>";

    } else
    
    echo <<<_END
    <html>
    <head>
        <title>Suma numeros</title>
    </head>
    <body>
        <form action="calculadora.php" method="post">

        <h2>Cliente</h2>
        <label>num1</label> <input type="text" name="num1">
        <br><br>
        <label>num2</label> <input type="text" name="num2">
        <br><br>
        <label>operador</label> <input type="text" name="ope">
        <br><br>
        <input type="submit" value="Enviar">
        </form>

    </body>
    </html>
    _END;

?>
