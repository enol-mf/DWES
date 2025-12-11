<?php
session_start();

// Lista de palabras
$palabras = ['sol', 'luna', 'estrella', 'nube'];
$pista = ['calor y luz', 'brilla de noche', 'en el cielo', 'blanca y suave'];

// Elegir aleatoriamente
$indice = rand(0, count($palabras)-1);
$_SESSION['palabra'] = $palabras[$indice];
$_SESSION['pista'] = $pista[$indice];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego 1 - Adivina la palabra</title>
</head>
<body>
    <h1>Adivina la palabra secreta</h1>
    <p>Pista: <?php echo $_SESSION['pista']; ?></p>
    <form action="resultado1.php" method="post">
        <label>Palabra: </label>
        <input type="text" name="respuesta">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
