<?php
session_start();

$combi = $_SESSION['numAleatorio'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="Juego.php" method="post">
        <h1>Simón</h1>
        <h2>Pulsa los botones en el orden correspondiente</h2>
        <img src="n.png" alt="" height="200px">
        <img src="n.png" alt="" height="200px">
        <img src="n.png" alt="" height="200px">
        <img src="n.png" alt="" height="200px">
        
    <br>
    <div class="contenedor">
        <input type="button" value="ROJO" class="r">
        <input type="button" value="AZUL" class="b">
        <input type="button" value="AMARILLO" class="y">
        <input type="button" value="VERDE" class="g">
    </div>
    <br>
    <input type="submit">
    </form>
</body>
</html>