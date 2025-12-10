<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ejAsociativos.php" method="post">
        <label for="">Enter a country</label>
        <input type="text" name="country">
        <input type="submit">
    </form>
</body>
</html>
<?php 

    $capitals = array("USA"=>"Washington DC",
                    "Japan"=>"Kyoto",
                    "South Korea"=>"Seoul",
                    "India"=>"New Delhi");

    $capital = $_POST["country"];

    foreach($capitals as $key=>$value) {
        if ($capital == $key) {
            echo"La capital de {$key} es {$value}";
        };
    }

?>