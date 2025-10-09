<?php

    if ($_POST['ope'] == "+") {
        $resul = $_POST['num1']+$_POST['num2'];
    } elseif ($_POST['ope'] == "-") {
        $resul = $_POST['num1']-$_POST['num2'];
    } elseif ($_POST['ope'] == "*") {
        $resul = $_POST['num1']*$_POST['num2'];
    } elseif ($_POST['ope'] == "/") {
        $resul = $_POST['num1']/$_POST['num2'];
    } else {
        echo "opcion no valida";
    }

    echo "El resultado es $resul"


?>