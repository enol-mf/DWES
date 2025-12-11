<?php
session_start();

function determinar_ganador($jugador, $computadora) {
    if ($jugador === $computadora) {
        return "Empate";
    }

    if (
        ($jugador === 'piedra' && $computadora === 'tijera') ||
        ($jugador === 'papel' && $computadora === 'piedra') ||
        ($jugador === 'tijera' && $computadora === 'papel')
    ) {
        return "Ganaste";
    } else {
        return "Perdiste";
    }
}

$resultado_juego = "";
$eleccion_jugador = "";
$eleccion_computadora = "";
$opciones = ['piedra', 'papel', 'tijera'];

if (isset($_POST['jugada'])) {
    $eleccion_jugador = strtolower($_POST['jugada']);
    $eleccion_computadora = $opciones[array_rand($opciones)];
    $resultado_juego = determinar_ganador($eleccion_jugador, $eleccion_computadora);

    if (!isset($_SESSION['historial'])) {
        $_SESSION['historial'] = [];
    }
    array_unshift($_SESSION['historial'], [
        'jugador' => $eleccion_jugador,
        'computadora' => $eleccion_computadora,
        'resultado' => $resultado_juego,
        'hora' => date("H:i:s")
    ]);
    $_SESSION['historial'] = array_slice($_SESSION['historial'], 0, 5);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra, Papel o Tijera</title>
</head>
<body>
    <h1>Juego de Piedra, Papel o Tijera</h1>

    <form action="piedraPapel.php" method="post">
        <label for="jugada">Elige tu jugada:</label><br>
        
        <input type="radio" id="piedra" name="jugada" value="piedra" required>
        <label for="piedra">Piedra</label><br>
        
        <input type="radio" id="papel" name="jugada" value="papel">
        <label for="papel">Papel</label><br>
        
        <input type="radio" id="tijera" name="jugada" value="tijera">
        <label for="tijera">Tijera</label><br><br>
        
        <button type="submit">¡Jugar!</button>
    </form>

    <hr>

    <?php if (!empty($resultado_juego)): ?>
        <h2>Resultado de la partida</h2>
        <p>Tu elección: <strong><?php echo ucfirst($eleccion_jugador); ?></strong></p>
        <p>Computadora: <strong><?php echo ucfirst($eleccion_computadora); ?></strong></p>
        <h3>¡<?php echo $resultado_juego; ?>!</h3>
    <?php endif; ?>

    <?php if (isset($_SESSION['historial']) && !empty($_SESSION['historial'])): ?>
        <h3>Historial de Últimas Jugadas</h3>
        <table border="1">
            <tr>
                <th>Hora</th>
                <th>Tú</th>
                <th>Compu</th>
                <th>Resultado</th>
            </tr>
            <?php foreach ($_SESSION['historial'] as $partida): ?>
                <tr>
                    <td><?php echo $partida['hora']; ?></td>
                    <td><?php echo ucfirst($partida['jugador']); ?></td>
                    <td><?php echo ucfirst($partida['computadora']); ?></td>
                    <td><?php echo $partida['resultado']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>