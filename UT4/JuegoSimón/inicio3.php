<?php 
session_start();

// Si el usuario no está logueado, lo mandamos al login
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['dificultad']) && isset($_POST['numColores'])) {
    $dificultad = (int)$_POST['dificultad'];
    $numColores = (int)$_POST['numColores'];

    for ($i = 0; $i < $dificultad; $i++) {
        $numAleatorio[$i] = rand(0, $numColores - 1);
    }

    $_SESSION['numAleatorio'] = implode('', $numAleatorio);
    $_SESSION['numColores'] = $numColores;
} else {
    $dificultad = 4;
    $numColores = 4;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simón</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?></h1>
        <h2>Selecciona la dificultad</h2>
        <select name="dificultad">
            <?php
            for ($i = 4; $i <= 8; $i++) {
                $selected = ($i == $dificultad) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>

        <h2>Selecciona el número de colores</h2>
        <select name="numColores">
            <?php
            for ($i = 4; $i <= 8; $i++) {
                $selected = ($i == $numColores) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>

        <br><br>
        <input type="submit" value="Generar combinación">
    </form>

    <?php if (isset($numAleatorio)): ?>
        <h2>Memoriza la combinación</h2>
        <?php
        foreach ($numAleatorio as $num) {
            echo "<img src='{$num}.png' height='150px'>";
        }
        ?>
        <br><br>
        <form action="jugar3.php" method="post">
            <input type="hidden" name="dificultad" value="<?php echo $dificultad; ?>">
            <input type="hidden" name="numColores" value="<?php echo $numColores; ?>">
            <input type="submit" value="Jugar">
        </form>
    <?php endif; ?>

    <br><a href="estadisticas.php">Ver estadísticas</a> | <a href="logout.php">Cerrar sesión</a>
</body>
</html>
