<?php
session_start();

if (isset($_POST['dificultad'])) {
    $dificultad = (int)$_POST['dificultad'];
    for ($i = 0; $i < $dificultad; $i++) {
        $numAleatorio[$i] = rand(0, 3);
    }
    $_SESSION['numAleatorio'] = implode('', $numAleatorio);
} else {
    $dificultad = 4;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simón</title>
</head>
<body>
    <form action="" method="post">
        <h1>Simón</h1>
        <h2>Selecciona la dificultad</h2>
        <select name="dificultad">
            <?php
            for ($i = 4; $i <= 8; $i++) {
                $selected = ($i == $dificultad) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>
        <input type="submit" value="Generar combinación">
    </form>

    <?php if (isset($numAleatorio)): ?>
        <h2>Memoriza la combinación</h2>
        <?php
        foreach ($numAleatorio as $num) {
            echo "<img src='{$num}.png' height='200px'>";
        }
        ?>
        <br>
        <form action="jugar2.php" method="post">
            <input type="hidden" name="dificultad" value="<?php echo $dificultad; ?>">
            <input type="submit" value="Jugar">
        </form>
    <?php endif; ?>
</body>
</html>
