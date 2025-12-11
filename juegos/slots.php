<?php
session_start();

// --- 1. Configuración del Juego y Lógica ---

// Símbolos y sus valores/probabilidades (Peso de 1 a 10)
$simbolos = [
    '🍒' => ['peso' => 4, 'premio_doble' => 2, 'premio_triple' => 5], // Cereza (Común)
    '🍋' => ['peso' => 3, 'premio_doble' => 3, 'premio_triple' => 8], // Limón (Menos común)
    '🔔' => ['peso' => 2, 'premio_doble' => 5, 'premio_triple' => 15], // Campana (Raro)
    '7️⃣' => ['peso' => 1, 'premio_doble' => 10, 'premio_triple' => 30] // Siete (Jackpot - Muy raro)
];

// Inicialización de Variables
$resultado_giro = ["?", "?", "?"]; // Estado inicial de los rodillos
$mensaje_juego = "¡Bienvenido! Gira para empezar.";
$ganancia = 0;
$apuesta_minima = 5;

// Inicializar Saldo en la Sesión si no existe
if (!isset($_SESSION['creditos'])) {
    $_SESSION['creditos'] = 100; // Saldo inicial
}
$creditos_actuales = $_SESSION['creditos'];


/**
 * Genera un resultado aleatorio para un rodillo basado en el peso de los símbolos.
 * Devuelve el emoji del símbolo.
 */
function generar_simbolo($simbolos) {
    $pool = [];
    // Crear una "piscina" de símbolos basada en el peso para simular probabilidad
    foreach ($simbolos as $simbolo => $data) {
        for ($i = 0; $i < $data['peso']; $i++) {
            $pool[] = $simbolo;
        }
    }
    // Devolver un símbolo aleatorio de la piscina ponderada
    return $pool[array_rand($pool)];
}


// Procesar el formulario (El jugador ha presionado "Girar")
if (isset($_POST['apostar'])) {
    $apuesta = (int)$_POST['apostar'];

    // 1. Validaciones
    if ($apuesta < $apuesta_minima || $apuesta > $creditos_actuales) {
        $mensaje_juego = "Error: Apuesta inválida o saldo insuficiente (mínimo $apuesta_minima).";
    } else {
        // 2. Realizar Apuesta
        $_SESSION['creditos'] -= $apuesta;

        // 3. Generar el Giro (3 rodillos)
        $rodillo1 = generar_simbolo($simbolos);
        $rodillo2 = generar_simbolo($simbolos);
        $rodillo3 = generar_simbolo($simbolos);
        $resultado_giro = [$rodillo1, $rodillo2, $rodillo3];

        // 4. Evaluar Premios
        $ganancia = 0;

        if ($rodillo1 === $rodillo2 && $rodillo2 === $rodillo3) {
            // Tres iguales (TRIPLE MATCH)
            $simbolo_ganador = $rodillo1;
            $ganancia = $simbolos[$simbolo_ganador]['premio_triple'] * $apuesta;
            $mensaje_juego = "¡JACKPOT! 🥳 Tres {$simbolo_ganador} te dan {$ganancia} créditos.";
        } elseif ($rodillo1 === $rodillo2 || $rodillo2 === $rodillo3 || $rodillo1 === $rodillo3) {
            // Dos iguales (DOUBLE MATCH) - Simplificamos, solo evaluamos rodillo 1 y 2
            $simbolo_ganador = ($rodillo1 === $rodillo2) ? $rodillo1 : $rodillo2; 
            // Si el 1 y 2 no son iguales, debe ser 2 y 3 o 1 y 3. Usamos 2 o 3 para el premio.
            if ($rodillo1 !== $rodillo2) { 
                $simbolo_ganador = $rodillo2; // Si 1 y 2 fallan, tomamos el 2 (que coincide con el 3)
            }
            
            // Si $rodillo1 === $rodillo2, $simbolo_ganador es $rodillo1
            // Si $rodillo2 === $rodillo3, $simbolo_ganador es $rodillo2
            
            // La lógica simplificada de triple: 
            // Solo verifica si hay TRES iguales, si no, se asume DOBLE si hay dos.
            
            // Re-evaluación para ser más justo en doble match:
            // Buscamos cuál símbolo tiene más repeticiones
            $conteo = array_count_values($resultado_giro);
            $max_repeticiones = max($conteo);
            
            if ($max_repeticiones === 2) {
                $simbolo_ganador = array_search(2, $conteo);
                $ganancia = $simbolos[$simbolo_ganador]['premio_doble'] * $apuesta;
                $mensaje_juego = "¡Doble Match! Dos {$simbolo_ganador} te dan {$ganancia} créditos.";
            }

        } else {
            $mensaje_juego = "Mejor suerte la próxima vez. ¡Sigue intentando!";
        }

        // 5. Actualizar Saldo Final
        $_SESSION['creditos'] += $ganancia;
        $creditos_actuales = $_SESSION['creditos'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máquina Tragaperras PHP</title>
</head>
<body>
    <h1>Simulador de Máquina Tragaperras</h1>

    <h2>Saldo Actual: <?php echo $creditos_actuales; ?> créditos</h2>
    <p>Apuesta mínima: <?php echo $apuesta_minima; ?> créditos</p>
    
    <hr>
    
    <div style="font-size: 48px; text-align: center; border: 2px solid black; padding: 10px; width: 300px; margin: 20px auto;">
        <?php echo $resultado_giro[0]; ?> | <?php echo $resultado_giro[1]; ?> | <?php echo $resultado_giro[2]; ?>
    </div>

    <p style="text-align: center; font-weight: bold;"><?php echo $mensaje_juego; ?></p>
    
    <hr>

    <?php if ($creditos_actuales >= $apuesta_minima): ?>
        <form action="slots.php" method="post" style="text-align: center;">
            <label for="apostar">Cantidad a apostar:</label>
            <input type="number" id="apostar" name="apostar" min="<?php echo $apuesta_minima; ?>" max="<?php echo $creditos_actuales; ?>" value="<?php echo $apuesta_minima; ?>" required>
            <button type="submit">¡Girar Rodillos!</button>
        </form>
    <?php else: ?>
        <p style="color: red; text-align: center; font-size: 1.2em;">GAME OVER. ¡Te has quedado sin créditos!</p>
        <form action="slots.php" method="post" style="text-align: center;">
            <button type="submit" name="reiniciar">Reiniciar juego (100 créditos)</button>
        </form>
    <?php endif; ?>
    
    <?php
    // Lógica de Reinicio
    if (isset($_POST['reiniciar'])) {
        $_SESSION['creditos'] = 100;
        // Redirección para evitar reenvío del formulario
        header("Location: slots.php");
        exit;
    }
    ?>
    
    <hr>
    
    <h3>Tabla de Premios (Multiplicador de la Apuesta)</h3>
    <table border="1" style="width: 300px; margin: 0 auto;">
        <tr>
            <th>Símbolo</th>
            <th>Doble (x2)</th>
            <th>Triple (x3)</th>
        </tr>
        <?php foreach ($simbolos as $simbolo => $data): ?>
            <tr>
                <td><?php echo $simbolo; ?></td>
                <td>x<?php echo $data['premio_doble']; ?></td>
                <td>x<?php echo $data['premio_triple']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>