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

    // $sql = "SELECT * FROM users WHERE user = 'Spongebob'";
    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql);
    
    if(mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_assoc($result)){
        echo $row["id"] ."<br>";
        echo $row["user"] ."<br>";
        };
    } else {
        echo"No user found";
    }

    mysqli_close($connection);
?>