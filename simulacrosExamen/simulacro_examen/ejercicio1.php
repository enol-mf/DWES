<?php
    session_start();

    function printForm() {
        echo <<<_END
            <form action="ejercicio1.php" method="post">
                <input type="text" name="dni" placeholder="DNI"/>
                <input type="submit" value="ENTRAR"/>
            <form/>
        _END;
    }

    if (isset($_POST['dni'])) {
        $un = 'root';
        $db = 'oposicion';
        $hn = 'localhost';
        $pw = '';

        $conn = new mysqli($hn, $un, $pw, $db);

        $dni = $_POST['dni'];
        $queryAlumnos = "SELECT * FROM alumno WHERE dniA = '$dni'";
        $queryProfesores = "SELECT * FROM profesor WHERE dniP = '$dni'";

        $userExists = false; /* NO HACE FALTA PERO POR TENERLO EN CUENTA */

        $prepareAlumnos = $conn->query($queryAlumnos);
        while($row = $prepareAlumnos->fetch_assoc()) {
            $userExists = true;
            $_SESSION['dni'] = $dni;
            header("Location: ejercicio3.php");
        }
        
        $prepareProfesor = $conn->query($queryProfesores);
        while($row = $prepareProfesor->fetch_assoc()) {
            $userExists = true;
            $_SESSION['dni'] = $dni;
            header("Location: ejercicio2.php");
        }

        if (!$userExists) {
            echo "No existe ningun alumno ni profesor con el DNI $dni <br/>";
        }
    }

    printForm();
?>