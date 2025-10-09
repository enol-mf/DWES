<?php

// 1. Crea el código PHP para inicializar los siguientes arrays y realizar las operaciones
// indicadas.
// a) Declara un array de enteros de nombre $coches e introduce en él 8 elementos
// cuyos valores sean 32, 11, 45, 22, 78, -3, 9, 66, 5. A continuación muestra por
// pantalla el elemento con localizador 5. Deberás obtener por pantalla que se
// visualiza -3.
// b) Declara un array de numéricos decimales tipo double de nombre $importe e
// introduce en él cuatro elementos que sean 32.583, 11.239, 45.781, 22.237. A
// continuación muestra por pantalla el elemento con localizador 1 y el 3..
// c) Declara un array de booleanos de nombre $confirmado e introduce en él seis
// elementos que sean true, true, false, true, false, false. A continuación muestra por
// pantalla el elemento con localizador cero. Deberás obtener por pantalla que se
// muestra “true”.
// d) Declara un array de strings de nombre $jugador e introduce en él 5 elementos
// que sean "Crovic", "Antic", "Malic", "Zulic" y "Rostrich". A continuación usando el
// operador de concatenación haz que se muestre la frase: <<La alineación del
// equipo está compuesta por Crovic, Antic, Malic, Zulic y Rostrich.>>

// $coches = array(31, 11, 45, 22, 78, -3, 9, 66, 5);
// echo $coches[5]."<br>";

// $importe = array(32.583, 11.239, 45.781, 22.237);
// echo $importe[1]."<br>";
// echo $importe[3]."<br>";

// $confirmado = array(true, true, false, true, false, false);
// echo $confirmado[1]."<br>";

// $jugador = array("Crovic", "Antic", "Malic", "Zulic", "Rostrich");
// echo "La alineación del equipo está compuesta por $jugador[0], $jugador[1], $jugador[2], $jugador[3] y $jugador[4]."


// 2. Crea el código que dé respuesta al siguiente planteamiento:
// Queremos almacenar en una matriz el número de alumnos con el que cuenta una
// academia, ordenados en función del nivel y del idioma que se estudia. Tendremos
// 3 filas que representarán al Nivel básico, medio y de perfeccionamiento y 4
// columnas en las que figurarán los idiomas (0 = Inglés, 1 = Francés, 2 = Alemán y 3
// = Ruso). Mostrar por pantalla los alumnos que existen en cada nivel e idioma.

// $alumnos = array(
//     [1,14,8,3],
//     [6,19,7,2],
//     [3,13,4,1]
// );

// $nivel = array("Nivel básico ","Nivel medio ","Nivel de perfeccionamiento ");
// $idiomas = array("Inglés ","Francés ","Alemán ","Ruso ");

// for ($i = 0; $i < count($alumnos); $i++) {
//     echo "<br>".$nivel[$i]."<br><br>";
//     for ($j = 0; $j < count($alumnos[$i]); $j++) {
//         echo $idiomas[$j].$alumnos[$i][$j]."<br>";
//     };
// };

// 3. Almacena en un array los 10 primeros números pares. Imprímelos cada uno en
// una línea.

// $numsPares = array();

// for ($i = 0; $i < 10; $i++) {
//     $numsPares[$i] = $i * 2;
// }
// print_r($numsPares);

// 4. Genera una matriz de 4*4 de forma aleatoria con números enteros desordenados
// mostrar en un renglón los elementos almacenados en la diagonal principal y en el
// siguiente los de la diagonal secundaria.

$matriz = array();

for ($i = 0; $i < 4; $i++) {
    
    
}
?>