<?php
    $db_server = "localhost:3307";
    $db_user = "root";
    $db_pass = "";
    $db_name = "businessdb";
    $connection = "";
    
    //El try/catch no es necesario, solo hace q en caso de q NO se conecte a la bbdd
    //suelte el echo en vez del fatal error
    try{
        $connection = mysqli_connect($db_server,$db_user,$db_pass,$db_name);    
    } catch(mysqli_sql_exception) {
        echo "No estas conectado";
    }
   
    if ($connection) {
        echo "Estas conectado";
    }
?>