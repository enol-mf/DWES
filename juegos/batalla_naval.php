<?php
session_start();

// --- 1. CONFIGURACIÓN DEL JUEGO ---

define('TAMANO_TABLERO', 5); // Tablero de 5x5 (puedes aumentar a 10)
define('NUM_BARCOS', 3);     // Número total de barcos pequeños (1 casilla)

// Símbolos para el tablero (visible al jugador)
define('AGUA', '~');         // Casilla no disparada (agua)
define('FALLO', 'X');        // Disparo en agua
define('ACIERTO', '💥');    // Disparo en barco (Tocado)
define('BARCO_OCULTO', 'B'); // Casilla con barco (solo se usa en el array secreto)

// Inicialización de Variables
$mensaje_juego = "";
$disparos_restantes = isset($_SESSION['disparos']) ? $_SESSION['disparos'] : 0;
$aciertos_restantes = isset($_SESSION['aciertos_pendientes']) ? $_SESSION['aciertos_pendientes'] : NUM_BARCOS;

// --- 2. FUNCIONES DE LÓGICA ---

/**
 * Inicializa el tablero y lo guarda en la sesión.
 * Coloca los barcos aleatoriamente.
 */
function inicializar_tablero() {
    $tablero_visible = [];
    $tablero_secreto = [];

    // Llenar el tablero con agua (~)
    for ($i = 0; $i < TAMANO_TABLERO; $i++) {
        for ($j = 0; $j < TAMANO_TABLERO; $j++) {
            $tablero_visible[$i][$j] = AGUA;
            $tablero_secreto[$i][$j] = 0; // 0 = Agua, 1 = Barco
        }
    }

    // Colocar los barcos
    $barcos_colocados = 0;
    while ($barcos_colocados < NUM_BARCOS) {
        $fila = rand(0, TAMANO_TABLERO - 1);
        $columna = rand(0, TAMANO_TABLERO - 1);

        // Si la casilla está libre, colocar el barco
        if ($tablero_secreto[$fila][$columna] === 0) {
            $tablero_secreto[$fila][$columna] = 1;
            $barcos_colocados++;
        }
    }

    // Guardar en sesión
    $_SESSION['tablero_visible'] = $tablero_visible;
    $_SESSION['tablero_secreto'] = $tablero_secreto;
    $_SESSION['disparos'] = 25; // Número de disparos máximos
    $_SESSION['aciertos_pendientes'] = NUM_BARCOS;
    $_SESSION['juego_activo'] = true;
    $_SESSION['mensajes'] = ["Juego reiniciado. ¡Encuentra los $barcos_colocados barcos!"];
}

/**
 * Procesa el disparo del jugador.
 * @param string $coordenada Coordenada en formato A1, B3, etc.
 */
function procesar_disparo($coordenada) {
    global $mensaje_juego;
    $mensajes_anterior = $_SESSION['mensajes'];

    // 1. Validar y traducir la coordenada (Ej: B3 -> [1][2])
    // La fila se traduce de letra (A=0, B=1) y la columna de número (1=0, 2=1)
    $coordenada = strtoupper(trim($coordenada));
    
    if (strlen($coordenada) < 2 || strlen($coordenada) > 3) {
        $mensaje_juego = "Error: Coordenada inválida. Usa formato A1, B5, etc.";
        $_SESSION['mensajes'] = array_merge($mensajes_anterior, [$mensaje_juego]);
        return;
    }

    $letra_fila = $coordenada[0];
    $num_columna = substr($coordenada, 1);

    $fila = ord($letra_fila) - ord('A'); // A=0, B=1, etc.
    $columna = (int)$num_columna - 1;    // 1=0, 2=1, etc.

    // 2. Comprobar que esté dentro de los límites
    if ($fila < 0 || $fila >= TAMANO_TABLERO || $columna < 0 || $columna >= TAMANO_TABLERO) {
        $mensaje_juego = "Error: Coordenada ($coordenada) fuera de los límites del tablero.";
        $_SESSION['mensajes'] = array_merge($mensajes_anterior, [$mensaje_juego]);
        return;
    }

    // 3. Comprobar si ya se disparó a esa casilla
    if ($_SESSION['tablero_visible'][$fila][$columna] !== AGUA) {
        $mensaje_juego = "Error: ¡Ya disparaste a ($coordenada)! Elige otra casilla.";
        $_SESSION['mensajes'] = array_merge($mensajes_anterior, [$mensaje_juego]);
        return;
    }

    // 4. Procesar el disparo
    $_SESSION['disparos']--;

    if ($_SESSION['tablero_secreto'][$fila][$columna] === 1) {
        // ACIERTO
        $_SESSION['tablero_visible'][$fila][$columna] = ACIERTO;
        $_SESSION['aciertos_pendientes']--;
        $mensaje_juego = "¡ACIERTO en ($coordenada)! Te quedan " . $_SESSION['aciertos_pendientes'] . " por encontrar.";
    } else {
        // FALLO
        $_SESSION['tablero_visible'][$fila][$columna] = FALLO;
        $mensaje_juego = "¡FALLO en ($coordenada)!";
    }
    
    // Añadir el último mensaje al historial (limitamos el historial a 5 mensajes)
    array_unshift($_SESSION['mensajes'], $mensaje_juego);
    $_SESSION['mensajes'] = array_slice($_SESSION['mensajes'], 0, 5);
}


// --- 3. GESTIÓN DEL FLUJO DEL JUEGO ---

// 3.1. Reiniciar Juego
if (isset($_POST['reiniciar']) || !isset($_SESSION['juego_activo'])) {
    inicializar_tablero();
}

// 3.2. Procesar Disparo
if (isset($_POST['coordenada']) && $_SESSION['juego_activo']) {
    procesar_disparo($_POST['coordenada']);
}

// 3.3. Comprobar Fin del Juego (Victoria o Derrota)
if ($_SESSION['juego_activo']) {
    if ($_SESSION['aciertos_pendientes'] === 0) {
        $mensaje_juego = "¡VICTORIA! 🎉 Has hundido toda la flota. Disparos usados: " . (25 - $_SESSION['disparos']);
        $_SESSION['juego_activo'] = false;
    } elseif ($_SESSION['disparos'] <= 0) {
        $mensaje_juego = "¡DERROTA! 😭 Te quedaste sin disparos. Los barcos restantes no fueron encontrados.";
        $_SESSION['juego_activo'] = false;
    }
}
$disparos_restantes = $_SESSION['disparos'];
$aciertos_restantes = $_SESSION['aciertos_pendientes'];

// --- 4. PRESENTACIÓN HTML ---
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hundir la Flota - PHP</title>
</head>
<body>
    <h1>🚢 Hundir la Flota (Batalla Naval)</h1>
    <p>Objetivo: Encontrar los <?php echo NUM_BARCOS; ?> barcos ocultos en el tablero de <?php echo TAMANO_TABLERO; ?>x<?php echo TAMANO_TABLERO; ?>.</p>

    <h2>Estado del Juego</h2>
    <p>Disparos restantes: <strong><?php echo $disparos_restantes; ?></strong> | Barcos restantes: <strong><?php echo $aciertos_restantes; ?></strong></p>

    <?php if ($mensaje_juego): ?>
        <p style="font-weight: bold; color: <?php echo ($_SESSION['juego_activo'] === false) ? 'red' : 'blue'; ?>;">
            <?php echo $mensaje_juego; ?>
        </p>
    <?php endif; ?>

    <hr>
    
    <h3>Tablero (<?php echo TAMANO_TABLERO; ?>x<?php echo TAMANO_TABLERO; ?>)</h3>
    <table border="1">
        <tr>
            <th></th> <?php
            // Encabezados de Columna (1, 2, 3...)
            for ($c = 1; $c <= TAMANO_TABLERO; $c++) {
                echo "<th>$c</th>";
            }
            ?>
        </tr>
        <?php
        // Contenido del Tablero
        $letras_fila = range('A', chr(ord('A') + TAMANO_TABLERO - 1));
        for ($f = 0; $f < TAMANO_TABLERO; $f++) {
            echo "<tr>";
            echo "<th>" . $letras_fila[$f] . "</th>"; // Encabezado de Fila (A, B, C...)

            for ($c = 0; $c < TAMANO_TABLERO; $c++) {
                $casilla = $_SESSION['tablero_visible'][$f][$c];
                $color = '';
                if ($casilla === ACIERTO) { $color = 'green'; }
                if ($casilla === FALLO) { $color = 'gray'; }
                
                // Genera la casilla con el contenido
                echo "<td style='text-align: center; width: 30px; height: 30px; background-color: $color;'>$casilla</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <hr>

    <?php if ($_SESSION['juego_activo']): ?>
        <h3>Realizar Disparo</h3>
        <form action="batalla_naval.php" method="post">
            <label for="coordenada">Coordenada (Ej: A1, B5):</label>
            <input type="text" name="coordenada" maxlength="2" style="text-transform: uppercase;" required>
            <button type="submit">¡Disparar!</button>
        </form>
    <?php else: ?>
        <h3>Juego Terminado</h3>
    <?php endif; ?>
    
    <form action="batalla_naval.php" method="post" style="margin-top: 15px;">
        <button type="submit" name="reiniciar">Reiniciar Nuevo Juego</button>
    </form>
    
    <hr>
    
    <h4>Historial Reciente</h4>
    <?php if (isset($_SESSION['mensajes'])): ?>
        <ul>
            <?php foreach ($_SESSION['mensajes'] as $msg): ?>
                <li><?php echo $msg; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>
</html>