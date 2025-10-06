<?php

        // 1. Dados 2 números asignados dentro del código a variables realizar el siguiente
        // cálculo: si son iguales que los multiplique, si el primero es mayor que el segundo
        // que los reste y si no que los sume. Mostrar el resultado en pantalla

        // $num1 = 2;
        // $num2 = 2;

        // if ($num1 == $num2) {
        //     echo "Son iguales, el resultado es: " . $num1 * $num2;
        // } elseif ($num1 > $num2) {
        //     echo "El primero es mayor, es resultado es: " . $num1 - $num2;
        // } else {
        //     echo "El segundo es mayor, el resultado es: " . $num1 + $num2;
        // }

        // 2. Dados 3 números asignados dentro del código a mostrar el número mayor de los
        // tres

        // $num1 = 2;
        // $num2 = 6;
        // $num3 = 4;
        // $numMayor = 0;

        // if ($num1 > $num2 && $num1 > $num3) {
        //     $numMayor = $num1;
        // } elseif ($num2 > $num3 && $num2 > $num1) {
        //     $numMayor = $num2;
        // } else {
        //     $numMayor = $num3;
        // }

        // echo $numMayor;


        // 3. Determinar la cantidad de dinero que recibirá un trabajador por concepto de las
        // horas extras trabajadas en una empresa, sabiendo que cuando las horas de
        // trabajo exceden de 40, el resto se consideran horas extras y que estas se pagan al
        // doble de una hora normal cuando no exceden de 8; si las horas extras exceden de
        // 8 se pagan las primeras 8 al doble de lo que se pagan las horas normales y el resto
        // al triple

        // $horasTrabajadas = 55;
        // $horaNormal = 10;
        // $pagoTotal = 0;

        // if ($horasTrabajadas <= 40) {
        //     $pagoTotal = $horasTrabajadas * $horaNormal;
        // } else {
        //     $horasExtras = $horasTrabajadas - 40;
        //     $pagoNormal = 40 * $horaNormal;
        //     if ($horasExtras <= 8) {
        //         $pagoExtras = $horasExtras * $horaNormal * 2;
        //     } else {
        //         $pagoExtras = 8 * $horaNormal * 2 + ($horasExtras - 8) * $horaNormal * 3;
        //     }
        //     $pagoTotal = $pagoNormal + $pagoExtras;
        // }
        // echo "\nPago total: $pagoTotal";


        // 4. Identificar entre dos números aleatorios cual es el mayor y si este es par o impar.
        // Buscar información previamente para generar números aleatorios y usarla para
        // resolver el ejercicio.


        // $num1 = rand(min: 0, max: 10);
        // $num2 = rand(min: 0, max: 10); 
        
        // if ($num1 > $num2) {
        //     echo $num1." "."Es mayor que "." ".$num2;
        // } else {
        //     echo $num2." Es mayor que ".$num1;
        // }


        // 5. Crear un programa partir de 3 valores, a b y c que corresponden a los tres
        // coeficientes de una ecuación de segundo grado muestre las soluciones de la
        // misma La solución de la ecuación de segundo grado depende del signo de b2-4ac:
        //  si b2-4ac es negativo no hay soluciones
        //  si es nulo, hay sólo una solución -b/2a
        //  si es positivo, hay dos soluciones: (-b+sqrt(b2-4ac))/(2a) y (-bsqrt(b2-4ac))/(2a)

        // $a = rand(1, 100); // Evita a=0
        // $b = rand(0, 100);
        // $c = rand(0, 100);
        
        // $conjunto = $b**2 - 4 * $a * $c;

        // if ($conjunto < 0) {
        //     echo "No hay solución";
        // } elseif ($conjunto == 0) {
        //     echo "La solución es: " . (-$b / (2 * $a));
        // } else {
        //     $sol1 = (-$b + sqrt($conjunto)) / (2 * $a);
        //     $sol2 = (-$b - sqrt($conjunto)) / (2 * $a);
        //     echo "Las soluciones son: $sol1 y $sol2";
        // }

        // 6. Crear un programa con bucle for para contar desde 0 a 50 de 5 en 5.

        for ($num = 0; $num < 50; $num+=5) {
            echo $num." ";
        }




    ?>