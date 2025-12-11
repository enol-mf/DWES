<?php
session_start();

// --- 1. CONFIGURACIÓN Y LÓGICA DEL JUEGO ---

define('SIZE', 3);
define('EMPTY_CELL', '-');
define('PLAYER_X', 'X');
define('PLAYER_O', 'O');

// Inicialización de Variables y Estado
$mensaje_juego = "";

/**
 * Inicializa el tablero y los estados del juego.
 */
function inicializar_juego() {
    $_SESSION['board'] = array_fill(0, SIZE, array_fill(0, SIZE, EMPTY_CELL));
    $_SESSION['turn'] = PLAYER_X; // Siempre empieza la X
    $_SESSION['status'] = 'active'; // 'active', 'win', 'draw'
    $_SESSION['moves'] = 0;
}

/**
 * Comprueba si hay un ganador en el tablero actual.
 * @param array $board El tablero de juego.
 * @return string|null Devuelve el símbolo del ganador (X o O) o null.
 */
function check_winner($board) {
    // Comprobar Filas y Columnas
    for ($i = 0; $i < SIZE; $i++) {
        // Fila: [0][0], [0][1], [0][2]
        if ($board[$i][0] !== EMPTY_CELL && $board[$i][0] === $board[$i][1] && $board[$i][1] === $board[$i][2]) {
            return $board[$i][0];
        }
        // Columna: [0][i], [1][i], [2][i]
        if ($board[0][$i] !== EMPTY_CELL && $board[0][$i] === $board[1][$i] && $board[1][$i] === $board[2][$i]) {
            return $board[0][$i];
        }
    }

    // Comprobar Diagonales
    // Diagonal principal: [0][0], [1][1], [2][2]
    if ($board[0][0] !== EMPTY_CELL && $board[0][0] === $board[1][1] && $board[1][1] === $board[2][2]) {
        return $board[0][0];
    }
    // Diagonal secundaria: [0][2], [1][1], [2][0]
    if ($board[0][2] !== EMPTY_CELL && $board[0][2] === $board[1][1] && $board[1][1] === $board[2][0]) {
        return $board[0][2];
    }

    return null;
}

// --- 2. FLUJO DE JUEGO Y ACCIONES ---

// Inicializar si es la primera vez o si se reinicia
if (!isset($_SESSION['board']) || isset($_POST['reiniciar'])) {
    inicializar_juego();
    $mensaje_juego = "¡El juego ha comenzado! Turno de " . PLAYER_X;
}

// Procesar el movimiento (si el juego está activo)
if (isset($_POST['move']) && $_SESSION['status'] === 'active') {
    list($row, $col) = explode(',', $_POST['move']);
    $row = (int)$row;
    $col = (int)$col;

    // 1. Validar el movimiento
    if ($row >= 0 && $row < SIZE && $col >= 0 && $col < SIZE && $_SESSION['board'][$row][$col] === EMPTY_CELL) {
        
        // 2. Realizar el movimiento y cambiar de turno
        $_SESSION['board'][$row][$col] = $_SESSION['turn'];
        $_SESSION['moves']++;

        // 3. Comprobar el estado del juego
        $ganador = check_winner($_SESSION['board']);

        if ($ganador) {
            $_SESSION['status'] = 'win';
            $mensaje_juego = "¡Felicidades! ¡El jugador **$ganador** ha ganado la partida!";
        } elseif ($_SESSION['moves'] === (SIZE * SIZE)) {
            $_SESSION['status'] = 'draw';
            $mensaje_juego = "¡Es un empate!";
        } else {
            // Continuar juego
            $_SESSION['turn'] = ($_SESSION['turn'] === PLAYER_X) ? PLAYER_O : PLAYER_X;
            $mensaje_juego = "Turno de **" . $_SESSION['turn'] . "**.";
        }
    } else {
        $mensaje_juego = "Movimiento inválido. Elige una casilla vacía.";
    }
}

// --- 3. PRESENTACIÓN HTML ---
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tres en Raya PHP</title>
</head>
<body>
    <h1>❌⭕ Tres en Raya (Tic-Tac-Toe)</h1>
    
    <p>Estado: <strong><?php echo ucfirst($_SESSION['status']); ?></strong></p>
    <p style="border: 1px solid black; padding: 10px;">
        <?php echo $mensaje_juego; ?>
    </p>

    <hr>
    
    <table border="1" style="border-collapse: collapse;">
        <?php for ($i = 0; $i < SIZE; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < SIZE; $j++): ?>
                    <td style="width: 50px; height: 50px; text-align: center; font-size: 24px;">
                        <?php if ($_SESSION['board'][$i][$j] === EMPTY_CELL && $_SESSION['status'] === 'active'): ?>
                            <form action="tres_en_raya.php" method="post" style="display: inline;">
                                <input type="hidden" name="move" value="<?php echo "$i,$j"; ?>">
                                <button type="submit" style="width: 100%; height: 100%; border: none; background: none; cursor: pointer;">
                                    &nbsp; </button>
                            </form>
                        <?php else: ?>
                            <?php echo $_SESSION['board'][$i][$j] === EMPTY_CELL ? '&nbsp;' : $_SESSION['board'][$i][$j]; ?>
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>

    <hr>
    
    <form action="tres_en_raya.php" method="post">
        <button type="submit" name="reiniciar">Reiniciar Partida</button>
    </form>
    
</body>
</html>