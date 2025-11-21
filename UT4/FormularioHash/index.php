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


if (isset($_POST['nom'], $_POST['mail'], $_POST['web'], $_POST['pass'], $_POST['comment'], $_POST['gender'])) {
    
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $web = $_POST['web'];
    $pass = $_POST['pass'];
    $comment = $_POST['comment'];
    $gender = $_POST['gender'];

    $mailErr = "Email correcto";
    $nameErr = "Nombre correcto";
    $passErr = ""; 


    if (empty($pass)) {
        $passErr = "La contraseña es obligatoria";
    } else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $pass)) {
            $passErr = "La contraseña debe tener mínimo 8 caracteres, mayúscula, minúscula, número y carácter especial";
        } else {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
        }
    }
    
    if (empty($_POST["nom"])) {
        $nameErr = "El nombre es obligatorio";
    } else {
        $name = test_input($_POST["nom"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$nom)) {
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
    echo $nameErr;
    echo "<p>Email: $mail</p>";
    echo $mailErr;
    echo "<p>Website: $web</p>";
    echo "<p>Comment: $comment</p>";
    echo "<p>Gender: $gender</p>";

    $sqlInsertDatos = "INSERT INTO datos (name, email, website, password, comment, gender) VALUES ('$nom', '$mail', '$web', '$pass', '$comment', '$gender')";
    $conexion->query($sqlInsertDatos);
    $conexion->close();
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
    <label for="name">Name: </label><input type="text" name="nom" id="nom"><br><br>
    <label for="mail">Email: </label><input type="text" name="mail" id="mail"><br><br>
    <label for="web">Website: </label><input type="text" name="web" id="web"><br><br>
    <label for="password">Password: </label><input type="password" name="pass" id="pass"><br><br>
    <label for="comment">Comment: </label><textarea name="comment" id="comment"></textarea><br><br>
    <label for="">Gender</label><input type="radio" name="gender" id="female" value="M">
    <label for="female">M</label><input type="radio" name="gender" id="male" value="H"><label for="male">H</label><br><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>

