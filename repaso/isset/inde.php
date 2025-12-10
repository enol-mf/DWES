<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="inde.php" method="post">
        <label for="">user: </label>
        <input type="text" name="user"><br>
        <label for="">pass: </label>
        <input type="password" name="pas"><br>
        <input type="submit" name="login" value="Log in"><br>
    </form>
</body>
</html>
<?php

    // foreach ($_POST as $key => $value) {
    //    echo"{$key} = {$value} <br>";  
    // }

    if(isset($_POST["login"])) {
        $username = $_POST["user"];
        $password = $_POST["pas"];

        if(empty($username)) {
            echo"Falta usuario";
        } elseif (empty($password)) {
            echo"Falta contraseña";
        } else {
            echo"Bienvenido {$username}";
        }
    }

    // $username = "";

    // if(isset($username)) {
    //     echo"existe <br>";
    // } else {
    //     echo"no existe <br>";
    // };

    // if(empty($username)) {
    //     echo"esta vacia <br>";
    // } else {
    //     echo"no esta vacia <br>";
    // };
?>