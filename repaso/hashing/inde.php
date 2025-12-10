<?php
    $password = "pizza123";
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "Contraseña: pizza123 <br>" ;
    echo "Contraseña: ". $hash;

    $pass = $_POST["pass"];

    if (isset($pass)) {
        if (password_verify($pass, $hash)) {
            echo "Las contraseñas coinciden";
        } else {
            echo "Las contraseñas no coinciden";
        }
    } else

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="inde.php" method="post">
        <label for="">Contraseña: </label>
        <input type="text" name="pass"> <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>