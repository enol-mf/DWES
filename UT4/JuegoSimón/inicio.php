<?php
session_start();

for ($i = 0; $i < 4; $i++) {
    $numAleatorio[$i] = rand(0, 3);
}

$_SESSION['numAleatorio'] = implode('', $numAleatorio);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="jugar.php" method="post">
        <h1>Simón</h1>
        <h2>Memoriza la combinación</h2>
<?php
        for ($i = 0; $i<4; $i++) {
            echo <<<_END
               <img src="$numAleatorio[$i].png" height="200px">
               _END;
        }
        
?>
    <br>
    <input type="submit">
    
    </form>
</body>
</html>