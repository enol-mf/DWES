<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="restaurante.php" method="post">
        <label for="">Cantidad: </label> <input type="number" name="cantidad" id=""> <br>
        <input type="submit" name="" id="" value="Total">
    </form>
</body>
</html>
<?php 
    $item = "sushi";
    $price = "3";
    $quantity = $_POST["cantidad"];
    $total = null;

    $total = $quantity * $price;

    echo"Has pedido {$item} {$quantity} veces.<br>";
    echo"El total es de: {$total}€";

?>