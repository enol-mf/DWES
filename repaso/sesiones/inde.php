<?php
    session_start();
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
        <label>user: </label>
        <input type="text" name="user"> <br>
        <label>password: </label>
        <input type="password" name="pass"> <br>
        <input type="submit" name="login">
    </form>
</body>
</html>
<?php
    if(isset($_POST["login"])) {
        if(empty($_POST["user"]) || empty($_POST["pass"])) {
            echo "Hay campos en blanco";
        } else {
            $_SESSION["user"]=$_POST["user"];
            $_SESSION["pass"]=$_POST["pass"];

            echo $_SESSION["user"]. "<br>";
            echo $_SESSION["pass"]. "<br>";

            header("Location: hom.php");
        }
    }
?>