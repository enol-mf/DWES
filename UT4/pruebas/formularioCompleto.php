<?php

    if (isset($_POST['nom']) && isset($_POST['ape']) && isset($_POST['edad']) && isset($_POST['profe']) && isset($_POST['sexo']) && isset($_POST['nav'])) {
        $nom = $_POST['nom'];
        $ape = $_POST['ape'];
        $edad = $_POST['edad'];
        $profe = $_POST['profe'];
        $sexo = $_POST['sexo'];
        $nav = $_POST['nav'];

        $navs = implode(", ", $nav);

        echo <<<_END
        <p> Nombre: $nom </p>
        <p> Apellido: $ape </p>
        <p> Edad: $edad </p>
        <p> Profesión: $profe </p>
        <p> Sexo: $sexo </p>
        <p> Navegador: $navs </p>

        _END;

    } else

        echo <<<_END
        <html>
        <head>
            <title>Document</title>
        </head>
        <body>
            <form action="formularioCompleto.php" method="post">
                <label for="">Nombre: </label> <input type="text" name="nom" id="nom"> <br>
                <label for="">Apellido: </label> <input type="text" name="ape" id="ape"> <br>
                <label for="">Edad: </label> <input type="number" name="edad" id="edad" max="99"> <br>
                <label for="">Profesión: </label>   <select name="profe">
                    <option value="Bombero">Bombero</option>
                    <option value="Profesor">Profesor</option>
                    <option value="Policia">Policia</option>
                </select> <br>
                <label for="">Sexo: </label> <input type="radio" name="sexo" value="Hombre"> <label for="">Hombre</label> <input type="radio" name="sexo" value="Mujer"> <label for="">Mujer</label> <br>
                <label for="">Navegador usado: </label>
                <input type="checkbox" name="nav[]" id="" value="Safari"> <label for="">Safari</label> 
                <input type="checkbox" name="nav[]" id="" value="Chrome"> <label for="">Chrome</label> 
                <input type="checkbox" name="nav[]" id="" value="Firefox"> <label for="">Firefox</label>
                <br>
                <input type="submit" value="Enviar">
            </form>
        </body>
        </html>
        
    _END;


?>