<?php

session_start();

if (isset($_POST['nom'])) {
        $_SESSION['nom']=$_POST['nom'];
}

if (isset($_SESSION['nom']) && isset($_POST['j1']) && isset($_POST['j2']) && isset($_POST['j3'])) { 
    $nom=$_SESSION['nom'];
    $j1=$_POST['j1'];
    $j2=$_POST['j2'];
    $j3=$_POST['j3'];
    
    
    echo <<<_END
    <p>
    Buenos días $nom, los jugadores que has elegido son: $j1, $j2 y $j3
    </p>

    _END;

    session_destroy();
    exit;
}

echo <<<_END

<head>
    <title>Document</title>
</head>
<body>
    <form action="script2.php" method="post">
        <label for="">Jugador1: </label> <input type="text" name="j1" id="">
        <br>
        <label for="">Jugador2: </label> <input type="text" name="j2" id="">
        <br>
        <label for="">Jugador3: </label> <input type="text" name="j3" id="">
        <br>
        <input type="submit" value="Jugar">
    </form>
</body>
</html>

_END;

?>