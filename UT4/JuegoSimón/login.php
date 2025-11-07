<?php
    $hn = 'localhost';
    $db = 'bdsimon';
    $un = 'root';
    $pw = ''; 
?>

<?php
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db); 
    if ($conn->connect_error) die("Fatal Error"); 
?>

<?php
    $query = "SELECT * FROM classics";
    $result = $conn->query($query);
    if (!$result) die("Fatal Error");
?> 