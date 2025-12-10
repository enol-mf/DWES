<?php
    session_start();

    function printAlumnoData() {
        $un = 'root';
        $db = 'oposicion';
        $hn = 'localhost';
        $pw = '';

        $conn = new mysqli($hn, $un, $pw, $db);
        
        $dni = $_SESSION['dni'];
        $result = $conn->query("SELECT * FROM ALUMNO WHERE dniA = '$dni'");
        
        while ($row = $result->fetch_assoc()) {
            $alumnoName = $row['nombreA'];
            echo <<<_END
                <ul style="display: flex; list-style-type: none; padding: 0">
                    <li style="padding:5px; background-color: #fcd4b3">ALUMNO: $dni<li/>
                    <li style="padding:5px; background-color: #b6dde8">NOMBRE: $alumnoName<li/>
                </ul>
            _END;
        }

    }
    
    function printForm() {
        $dni = $_SESSION['dni'];
        echo <<<_END
            <form action="ejercicio3.php" method="post" style="display: flex; flex-direction: column; width: fit-content;">
                <label for="dni">
                    DNI
                    <input id="dni" type="text" value="$dni" disabled required/>
                </label>
                <label for="codcurso">
                    COD CURSO
                    <input id="codcurso" type="text" name="codcurso" required/>
                </label>
                <label for="pruebaA">
                    Prueba A
                    <input id="pruebaA" type="number" name="pruebaA" required/>
                </label>
                <label for="pruebaB">
                    Prueba B
                    <input id="pruebaB" type="number" name="pruebaB" required/>
                </label>
                <label for="tipo">
                    TIPO
                    <input id="tipo" type="text" name="tipo" required/>
                </label>
                <label for="inscripcion">
                    INSCRIPCION
                    <input id="inscripcion" type="date" name="inscripcion" required/>
                </label>
                <input type="submit" value"MATRICULAR"/>
            </form>
        _END;
    }

    function matricularUsuario() {
        $codcurso = $_POST['codcurso'];
        $pruebaA = $_POST['pruebaA'];
        $pruebaB = $_POST['pruebaB'];
        $tipo = $_POST['tipo'];
        $inscripcion = $_POST['inscripcion'];

        $un = 'root';
        $db = 'oposicion';
        $hn = 'localhost';
        $pw = '';

        $conn = new mysqli($hn, $un, $pw, $db);
        
        $dni = $_SESSION['dni'];
        $result = $conn->query("SELECT * FROM curso WHERE codigocurso = '$codcurso'");

        if ($result && $result->num_rows == 0) {
            echo "El codigo del curso proporcionado no existe";
            return;
        }

        $alreadyExists = $conn->query("SELECT * FROM matricula WHERE dnialumno = '$dni' AND codcurso = '$codcurso'");
        if ($alreadyExists && $alreadyExists->num_rows > 0) {
            echo "El alumno $dni ya se encuentra matriculado en el curso $codcurso";
            return;
        }

        $insert = $conn->prepare('INSERT INTO matricula (dnialumno, codcurso, pruebaA, pruebaB, tipo, inscripcion) VALUES (?, ?, ?, ?, ?, ?)');
        $insert->bind_param('ssiiss', $dni, $codcurso, $pruebaA, $pruebaB, $tipo, $inscripcion);
        $insert->execute();

        if ($insert->affected_rows > 0) {
            echo "La matricula del alumno $dni en el curso $codcurso se ha realizado correctamente";
            return;
        }

        echo "Ha ocurrido un error al añadir el ususario";
    }

    function init() {
        if (!isset($_SESSION['dni'])) {
            echo "DNI del alumno no proporcionado";
            return;
        }

        printAlumnoData();
        printForm();

        if (isset($_POST['codcurso'])) {
            matricularUsuario();
        }
    }

    init()
?>