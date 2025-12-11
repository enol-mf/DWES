<?php
session_start();

$num = rand(1, 20); // número aleatorio
$_SESSION['num'] = $num;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego 2 - Par o impar</title>
</head>
<body>
    <h1>¿El número es par o impar?</h1>
    <p>Número: <?php echo $num; ?></p>
    <form action="resultado2.php" method="post">
        <input type="radio" name="respuesta" value="par" id="par"><label for="par">Par</label>
        <input type="radio" name="respuesta" value="impar" id="impar"><label for="impar">Impar</label>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
