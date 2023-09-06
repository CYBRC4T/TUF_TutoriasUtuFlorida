<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="img/logoIcon.svg">
        <title> TUF | Preparar Tutoría </title>
        <link rel="stylesheet" href="css/login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
                <script src="js/classManager.js"> </script>

        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body>
            <?php
                $conn = mysqli_connect("localhost", "root", "");
                $dbb = mysqli_select_db($conn, "tutorias");

                if(!isset($_POST['accion']))
                {
                    echo("<div class='container' id='act'>");

                    if($_POST['switch'] == 0)
                    {
                        $query = mysqli_query($conn, "SELECT MAX(id_tut) FROM tutorias");
                        $result = mysqli_fetch_array($query);
                    
                        $query2 = mysqli_query($conn, "INSERT INTO 
                        `tutorias`(`id_tut`, `materia`, `docente`, `fecha_creacion`, `tipo`, `area`) 
                        VALUES ('" . ($result[0] + 1) . "','" . $_POST['materia'] . "','" . $_COOKIE['ci']
                        . "','" . date('Y-m-d H:i:s') . "','" . $_POST['mod'] . "','" . $_POST['area'] . "')");
                    
                        $y = 0;
                        echo("<form action='subirTutoria.php' method='post' class='grid'>");
                        echo("<input type='hidden' id='dias' name='dias' value='" . $_POST['dias'] . "'>");
                        echo("<input type='hidden' id='id_tut' name='id_tut' value='" . ($result[0] + 1) . "'>");
                        echo("<input type='hidden' id='switch' name='switch' value='1'>");
                        while($y != $_POST['dias'])
                        {
                            $y++;
                            echo("<p> Día $y </p>");
                            echo("<div class='item' id='tut'> 
                                <label> Fecha: </label>
                                <blank></blank>
                                <label> Horario: </label>
                                <blank></blank>
                                <label> Salón </label>
                                <input type='date' id='fecha$y' name='fecha$y'>
                                <input type='time' id='hora_inicio$y' name='hora_inicio$y'>
                                <label> hasta </label>
                                <input type='time' id='hora_final$y' name='hora_final$y'>
                                <input type='number' id='salon$y' name='salon$y'>
                            </div>");
                        }
                        echo("<input type='submit' value='CONTINUAR'>");
                        echo("</form>");
                    } else {
                        $y = 0;
                        $x = 1;
                        while($y != $_POST['dias'])
                        {
                            $clases = mysqli_query($conn, "INSERT INTO `clases`(`id_tut`, `fecha`, `hora_inicio`, `hora_final`, `salon`, `realizado`)
                            VALUES ('" . $_POST['id_tut'] . "','" . $_POST['fecha' . $x] . "','" . $_POST['hora_inicio' . $x]
                            . "','" . $_POST['hora_final' . $x] . "','" . $_POST['salon' . $x] . "','')");
                            
                            $y++;
                            $x++;
                        }
                        echo ("<form action='inicioDoc.php' method='post' id='myForm'>");
                        echo ("<script>"
                                . "var varTimerInMiliseconds = 100;
                                    setTimeout(function(){ 
                                        document.getElementById('myForm').submit();
                                    }, varTimerInMiliseconds);"
                                . "</script>");
                        echo ("</form>");
                    }
                    echo("</div>");
                } else {
                    switch($_POST['accion'])
                    {
                        case 0:
                            if($_POST['switch'] == 0)
                            {
                                $query = mysqli_query($conn, "SELECT materias.nombre, tutorias.docente, docentes.nombre, tutorias.tipo, tutorias.id_tut
                                FROM tutorias, materias, docentes, clases WHERE tutorias.materia = materias.id_mat AND tutorias.docente = docentes.ci_doc AND tutorias.id_tut = " . $_POST['id_tuto']);

                                $query2 = mysqli_query($conn, "SELECT tutorias.docente AS id_doc, docentes.nombre AS docente 
                                FROM docentes, tutorias WHERE tutorias.docente = docentes.ci_doc");

                                $query3 = mysqli_query($conn, "SELECT * FROM clases WHERE id_tut = " . $_POST['id_tuto']);
                                
                                $result = mysqli_fetch_array($query);
                                
                                echo("<form action='subirTutoria.php' method='post' class='grid' id='edit'>");
                                    echo("<input type='hidden' name='switch' id='switch' value='1'>");
                                    echo("<input type='hidden' name='accion' id='accion' value='0'>");
                                    echo("<input type='hidden' name='id_tuto' id='id_tuto' value='" . $_POST['id_tuto'] . "'>");

                                    echo("<div class='subdiv'>");
                                        echo("<p> $result[0]#$result[4] </p>");
                                        echo("<div class='item' id='ediTuto'> 
                                                <label> Docente: </label>
                                                <label> Tipo: </label>
                                                <select id='docente' name='docente'>
                                                    <option value='" . $result[1] . "'>" . $result[2] . "</option>");
                                                    while($row = mysqli_fetch_array($query2)) 
                                                    {
                                                        if($row[0] != $result[1])
                                                        {
                                                            echo("<option value='" . $row[0] . "'>" . $row[1] . "</option>");
                                                        }
                                                    }
                                            echo("</select>
                                                <select id='tipo' name='tipo'>
                                                    <option value='coord'> Coordinación </option>
                                                    <option value='exam'> Exámenes </option>
                                                </select>
                                            </div>");
                                            $y = 1;
                                            while($row = mysqli_fetch_array($query3))
                                            {
                                                echo("<p> Día $y </p>");
                                                echo("<div class='item' id='tut'> 
                                                    <label> Fecha: </label>
                                                    <blank></blank>
                                                    <label> Horario: </label>
                                                    <blank></blank>
                                                    <label> Salón </label>
                                                    <input type='date' id='fecha$y' name='fecha$y' value='" . $row[2] . "'>
                                                    <input type='time' id='hora_inicio$y' name='hora_inicio$y' value='" . $row[3] . "'>
                                                    <label> hasta </label>
                                                    <input type='time' id='hora_final$y' name='hora_final$y' value='" . $row[4] . "'>
                                                    <input type='number' id='salon$y' name='salon$y' value='" . $row[5] . "'>
                                                </div>");
                                                $y++;
                                            }
                                            echo("<input type='hidden' name='cantClases' id='cantClases' value='" . ($y - 1) . "'>");
                                    echo("</div>");
                                    echo("<div class='item' id='btns'>");
                                        echo("<input type='submit' value='CONTINUAR'>");
                                        echo("<a onclick='window.history.back()'> VOLVER </a>");
                                    echo("</div>");
                                echo("</form>");
                            } else {
                                $query = mysqli_query($conn, "UPDATE tutorias SET docente='" . $_POST['docente'] . "', tipo='" . $_POST['tipo'] . "' WHERE id_tut = ". $_POST['id_tuto']);
                                $query2 = mysqli_query($conn, "SELECT id FROM clases WHERE id_tut = " . $_POST['id_tuto']);

                                $y = 1;
                                while($row = mysqli_fetch_array($query2))
                                {
                                    $query3 = mysqli_query($conn, "UPDATE clases SET fecha = '" . $_POST['fecha' . $y] . "', hora_inicio = '" . $_POST['hora_inicio' . $y] . "',
                                    hora_final = '" . $_POST['hora_final' . $y] . "', salon = '" . $_POST['salon' . $y] . "' WHERE id = " . $row[0]);
                                    $y++;
                                }

                                echo ("<form action='inicioAdm.php' method='post' id='myForm'>");
                                echo ("<script>"
                                        . "var varTimerInMiliseconds = 100;
                                            setTimeout(function(){ 
                                                document.getElementById('myForm').submit();
                                            }, varTimerInMiliseconds);"
                                        . "</script>");
                                echo ("</form>");
                            }
                            break;
                        case 1:
                            echo("DELETE FROM clases WHERE id_tut = " . $_POST['id_tuto']);
                            
                            $query = mysqli_query($conn, "DELETE FROM clases WHERE id_tut = " . $_POST['id_tuto']);
                            $query2 = mysqli_query($conn, "DELETE FROM tutorias WHERE id_tut = " . $_POST['id_tuto']);

                            echo ("<form action='inicioAdm.php' method='post' id='myForm'>");
                            echo ("<script>"
                                    . "var varTimerInMiliseconds = 100;
                                        setTimeout(function(){ 
                                            document.getElementById('myForm').submit();
                                        }, varTimerInMiliseconds);"
                                    . "</script>");
                            echo ("</form>");
                            break;
                    }
                }
            ?>
    </body>
</html>