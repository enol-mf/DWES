<?php
    $db_server = "localhost:3307";
    $db_user = "root";
    $db_pass = "";
    $db_name = "businessdb";
    $connection = "";
    //El try/catch no es necesario, solo hace q en caso de q NO se conecte a la bbdd
    //suelte el echo en vez del fatal error
    try{
        $connection = mysqli_connect($db_server,$db_user,$db_pass,$db_name);    
    } catch(mysqli_sql_exception) {
        echo "No estas conectado";
    }
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
        <h2>Bienvenido a Fakebook!</h2>
        <label for="">username: </label>
        <input type="text" name="user"> <br>
        <label for="">password: </label>
        <input type="password" name="pass"> <br>
        <button type="submit" name="submit">Registrarse</button>
    </form>
</body>
</html>
<?php  
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (empty($user) || empty($pass)) {
        echo "Hay campos vacios";
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(user, password)
                VALUES ('$user', '$hash')"; 
        try {
            mysqli_query($connection, $sql);
            echo "Hola $user, se ha registrado correctamente.";
        } catch(mysqli_sql_exception) {
            echo"No se pudo registrar";
        }
    }
    mysqli_close($connection);
?>