<?php
    session_start();

    function getProfesorData() {
        $un = 'root';
        $db = 'oposicion';
        $hn = 'localhost';
        $pw = '';

        $conn = new mysqli($hn, $un, $pw, $db);

        $dni = $_SESSION['dni'];
        $result = $conn->query("SELECT * FROM profesor WHERE dniP = '$dni'");
        while ($row = $result->fetch_assoc()) {
            $profesorName = $row['nombreP'];
            echo <<<_END
                <ul style="display: flex; list-style-type: none; padding: 0">
                    <li style="padding:5px; background-color: #fcd4b3">PROFESOR: $dni<li/>
                    <li style="padding:5px; background-color: #b6dde8">NOMBRE: $profesorName<li/>
                </ul>
            _END;
        }
    }

    function printTable() {
        $un = 'root';
        $db = 'oposicion';
        $hn = 'localhost';
        $pw = '';

        $conn = new mysqli($hn, $un, $pw, $db);

        echo <<<_END
            <table border='1' style='border-collapse: collapse'>
                <thead>
                    <tr>
                        <th style='padding: 5px'>codigocurso</th>
                        <th style='padding: 5px'>nombrecurso</th>
                        <th style='padding: 5px'>maxalumnos</th>
                        <th style='padding: 5px'>fechaini</th>
                        <th style='padding: 5px'>fechafin</th>
                        <th style='padding: 5px'>numhoras</th>
                        <th style='padding: 5px'>profesor</th>
                    </tr>
                </thead>
                <tbody>
        _END;
        
        $dni = $_SESSION['dni'];
        $result = $conn->query("SELECT * FROM curso WHERE profesor = '$dni'");

        $horasImpartidas = 0;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $col) {
                if ($key == "numhoras") {
                    $horasImpartidas = $horasImpartidas + intval($col);
                }
                echo "<td style='padding: 5px'>";
                echo $col;
                echo "</td>";
            }
            echo "</tr>";
        }
        
        echo <<<_END
                </tbody>
            </table>
        _END;



        echo "<p style='padding: 5px; margin-top: 20px; width: fit-content; background-color: #b6dde8; font-weight: 600;'>Total horas impartidas: $horasImpartidas</p>";
    }

    function init() {
        if (!isset($_SESSION['dni'])) {
            echo "No se ha especificado un DNI";
            return;
        }

        getProfesorData();
        printTable();
    }

    init();
?>