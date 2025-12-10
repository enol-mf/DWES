<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>body {background-color: grey;}</style>
</head>
<body>
    <form action="inde.php" method="post">
        <label for="">username: </label><br>
        <input type="text" name="username" id=""><br>
        <label for="">password: </label><br>
        <input type="password" name="password" id=""><br>
        <button type="submit">submit</button>
    </form>
</body>
</html>
<?php
    echo "{$_POST["username"]} <br>";
    echo "{$_POST["password"]} <br>";
?>