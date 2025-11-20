<?php
session_start();

$conexion = new mysqli("localhost:3307", "root", "", "ejformulario");
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos");
}

function test_input($valor) {
    $valor = trim($valor);
    $valor = stripslashes($valor);
    return $valor;
}


if (isset($_POST['name'], $_POST['mail'], $_POST['web'], $_POST['password'], $_POST['comment'], $_POST['gender'])) {
    
    $name = htmlspecialchars($_POST['name']);
    $mail = htmlspecialchars($_POST['mail']);
    $web = htmlspecialchars($_POST['web']);
    $comment = htmlspecialchars($_POST['comment']);
    $gender = htmlspecialchars($_POST['gender']);
    $mailErr = "Email correcto";
    $nameErr = "Nombre correcto";

    if (empty($_POST["name"])) {
        $nameErr = "El nombre es obligatorio";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Únicamente se permiten letras y espacios";
        }
    }

    if (empty($mail)) {
        $mailErr = "Se requiere Email";
    } else {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $mailErr = "Fomato de Email invalido";
        }
    }

    echo "<p>Nombre: $name</p>";
    echo "<p>Email: $mail</p>";
    echo "<p>Website: $web</p>";
    echo $mailErr;
    echo "<p>Comment: $comment</p>";
    echo "<p>Gender: $gender</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
<form action="index.php" method="post">
    <label for="name">Name: </label><input type="text" name="name" id="name"><br><br>
    <label for="mail">Email: </label><input type="text" name="mail" id="mail"><br><br>
    <label for="web">Website: </label><input type="text" name="web" id="web"><br><br>
    <label for="password">Password: </label><input type="password" name="password" id="password"><br><br>
    <label for="comment">Comment: </label><textarea name="comment" id="comment"></textarea><br><br>
    <label for="">Gender</label><input type="radio" name="gender" id="female" value="Female">
    <label for="female">Female</label><input type="radio" name="gender" id="male" value="Male"><label for="male">Male</label><br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>

