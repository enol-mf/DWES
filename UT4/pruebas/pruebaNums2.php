<?php

    if (isset($_POST['num1']) && isset($_POST['num2'])) {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];  
        $resultado = $num1 + $num2;

        echo <<<_END
        <html>
        <head>
            <title>Suma numeros</title>
        </head>
        <body>
            
            <form action="pruebaNums2.php" method="post">
            <h2>Cliente</h2>
            <label>num1</label> <input type="text" name="num1">
            <br><br>
            <label>num2</label> <input type="text" name="num2">
            <br><br>
            <input type="submit" value="Sumar">
            </form>
            <p> El resultado es $resultado </p>

        </body>
        </html>
        
        _END;

    } else
    
    echo <<<_END
    <html>
    <head>
        <title>Suma numeros</title>
    </head>
    <body>
        
        <form action="pruebaNums2.php" method="post">
        <h2>Cliente</h2>
        <label>num1</label> <input type="text" name="num1">
        <br><br>
        <label>num2</label> <input type="text" name="num2">
        <br><br>
        <input type="submit" value="Sumar">
        </form>

    </body>
    </html>

    _END;

?>