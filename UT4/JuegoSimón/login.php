<?php
$hn = 'localhost:3307';
$db = 'bdsimon';
$un = 'root';
$pw = '';
$connection = new mysqli($hn, $un, $pw, $db);

$query = "SELECT Nombre FROM usuarios";

     if ($connection->connect_error) die("Fatal Error");
     $result = $connection->query($query);
     if (!$result) die("Fatal Error");
     $rows = $result->num_rows;
     for ($j = 0 ; $j < $rows ; ++$j) {
        $result->data_seek($j);
        echo 'usuarios: ' .htmlspecialchars($result->fetch_assoc()['Nombre']) .'<br>';
     }
?>