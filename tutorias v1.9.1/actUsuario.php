<?php
    if(!isset($_COOKIE['ci']) || !isset($_COOKIE['rol']))
    {
        unset($_COOKIE['ci']);
        unset($_COOKIE['rol']);
        setcookie('ci', '', time() - 3600);
        setcookie('rol', '', time() - 3600);

        echo "<form action='index.php' method='post' id='myForm'>";
        echo "<script>"
                . "var varTimerInMiliseconds = 100;
                    setTimeout(function(){ 
                        document.getElementById('myForm').submit();
                    }, varTimerInMiliseconds);"
            . "</script>";
        echo "</form>";
    }
?>

<html lang='es'>
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="img/logoIcon.svg">
        <title> TUF | Actualizar Usuario </title>
        <link rel="stylesheet" href="css/login.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body onload="actualizarGrid()">
        <div class="bgBlur" id="act"></div>
        <?php
            function goBack()
            {
                echo "<script> window.history.back() </script>";
            }

            $conn = mysqli_connect("localhost", "root", "");
            $bdd = mysqli_select_db($conn, "tutorias");
            $cuenta = explode("_", $_POST['cuenta']);

            $ci = $cuenta[0];
            $rol = $cuenta[1];

            switch($_POST['type']) 
            {
                case 'est':
                    switch($rol)
                    {
                        case 'DOC':
                            echo($ci);
                            $query = mysqli_query($conn, "SELECT * FROM docentes WHERE ci_doc = $ci");

                            if($query) {
                                $result = array_unique(mysqli_fetch_array($query));
        
                                $query1 = mysqli_query($conn, "INSERT INTO estudiantes VALUES ('$result[0]','$result[1]','$result[2]',
                                '$result[3]','$result[5]','$result[6]','$result[7]')");

                                $query2 = mysqli_query($conn, "INSERT INTO telefonos VALUES ('$result[4]', '$ci')");

                                $remove = mysqli_query($conn, "DELETE FROM docentes WHERE ci_doc = $ci");
                                $remove = mysqli_query($conn, "DELETE FROM doc_areas WHERE ci_doc = $ci");
                            } else {
                                echo("<h1 class='act'> 'HUBO UN ERROR INESPERADO' </h1>");
                            }
                            goBack();
                            break;
                            
                        case 'ADM':
                            $query = mysqli_query($conn, "SELECT * FROM administradores WHERE ci_adm = $ci");

                            if($query) {
                                $result = mysqli_fetch_array($query);
        
                                $query1 = mysqli_query($conn, "INSERT INTO estudiantes VALUES ('$result[0]','$result[1]','$result[2]',
                                '$result[3]','$result[5]','$result[6]','$result[7]')");

                                $query2 = mysqli_query($conn, "INSERT INTO telefonos VALUES ('$result[4]', '$ci')");

                                $remove = mysqli_query($conn, "DELETE FROM administradores WHERE ci_adm = $ci");
                                $remove = mysqli_query($conn, "DELETE FROM doc_areas WHERE ci = $ci");
                            } else {
                                echo("<h1 class='act'> 'HUBO UN ERROR INESPERADO' </h1>");
                            }
                            goBack();
                            break;
                    }
                    break;
                
                case 'doc':
                    switch($rol)
                    {
                        case 'EST':
                            $query = mysqli_query($conn, "SELECT ci_est, nombre, apellido, direccion, biografia, email, contrasena, count(ci_est) FROM estudiantes WHERE ci_est = $ci");
                            $query1 = mysqli_query($conn, "SELECT telefono FROM telefonos WHERE ci_est = $ci");

                            if($query) {
                                $result = array_unique(mysqli_fetch_array($query));

                                if($result[7] != 0) {
                                    $result1 = array_unique(mysqli_fetch_array($query1));

                                    $query2 = mysqli_query($conn, "INSERT INTO docentes VALUES ('$result[0]','$result[1]','$result[2]',
                                    '$result[3]','$result1[0]','$result[4]','$result[5]','$result[6]')");
        
                                    $remove = mysqli_query($conn, "DELETE FROM estudiantes WHERE ci_est = $ci");
                                    $remove2 = mysqli_query($conn, "DELETE FROM telefonos WHERE ci_est = $ci");
                                        
                                    $areas = $_POST['areas'];
                                    $cant_areas = count($areas);
                                    for($x = 0; $x < $cant_areas; $x++)
                                    {
                                        $query3 = mysqli_query($conn, "INSERT INTO doc_areas VALUES ('', '$ci', '". $areas[$x] ."')");
                                    }

                                    goBack();
                                } else {
                                    echo("<h1 class='act'> 'HUBO UN ERROR INESPERADO' </h1>");
                                }
                            } else {
                                echo("<h1 class='act'> 'HUBO UN ERROR INESPERADO' </h1>");
                            }

                            break;
                        case 'ADM':
                            $query = mysqli_query($conn, "SELECT * FROM administradores WHERE ci_adm = $ci");

                            if($query) {
                                $result = mysqli_fetch_array($query);
    
                                $query1 = mysqli_query($conn, "INSERT INTO docentes VALUES ('$result[0]','$result[1]','$result[2]',
                                '$result[3]','$result[4]','$result[5]','$result[6]','$result[7]')");
    
                                $remove = mysqli_query($conn, "DELETE FROM administradores WHERE ci_adm = $ci");
                                goBack();
                            } else {
                                echo("<h1 class='act'> 'HUBO UN ERROR INESPERADO' </h1>");
                            }
                            
                            $areas = $_POST['areas'];
                            $cant_areas = count($_POST['areas']);
                            for($x = 0; $x < $cant_areas; $x++)
                            {
                                $query3 = mysqli_query($conn, "INSERT INTO doc_areas VALUES ('$ci', '$areas[$x]')");
                            }
                            goBack();
                            break;
                    }
                    break;

                case 'adm':
                    switch($rol)
                    {
                        case 'EST':
                            $query = mysqli_query($conn, "SELECT * FROM estudiantes WHERE ci_est = $ci");
                            $query1 = mysqli_query($conn, "SELECT telefono FROM telefonos WHERE ci_est = $ci");

                            if($query) {
                                $result = mysqli_fetch_array($query);
                                $result1 = mysqli_fetch_array($query1);

                                $query1 = mysqli_query($conn, "INSERT INTO administradores VALUES ('$result[0]','$result[1]','$result[2]',
                                '$result[3]','$result1[0]','$result[4]','$result[5]','$result[6]')");

                                $remove = mysqli_query($conn, "DELETE FROM estudiantes WHERE ci_est = $ci");
                                $remove2 = mysqli_query($conn, "DELETE FROM telefonos WHERE ci_est = $ci");
                            } else {
                                echo("<h1 class='act'> 'HUBO UN ERROR INESPERADO' </h1>");
                            }
                            goBack();
                            break;

                        case 'DOC':
                            $query = mysqli_query($conn, "SELECT * FROM docentes WHERE ci_doc = $ci");

                            if($query) {
                                $result = mysqli_fetch_array($query);

                                $query1 = mysqli_query($conn, "INSERT INTO administradores VALUES ('$result[0]','$result[1]','$result[2]',
                                '$result[3]','$result[4]','$result[5]','$result[6]','$result[7]')");

                                $remove = mysqli_query($conn, "DELETE FROM docentes WHERE ci_doc = $ci");
                            } else {
                                echo("<h1 class='act'> 'HUBO UN ERROR INESPERADO' </h1>");
                            }
                            goBack();
                            break;
                    }
                    break;

                case 'con':
                    $passhashed = password_hash($_POST['contra'], PASSWORD_DEFAULT);

                    switch($rol)
                    {
                        case 'EST':
                            $query = mysqli_query($conn, "UPDATE estudiantes SET contrasena = '$passhashed' WHERE ci_est = $ci");
                            break;
                        case 'DOC':
                            $query = mysqli_query($conn, "UPDATE docentes SET contrasena = '$passhashed' WHERE ci_doc = $ci");
                            break;
                        case 'ADM':
                            $query = mysqli_query($conn, "UPDATE administradores SET contrasena = '$passhashed' WHERE ci_adm = $ci");
                            break;
                    }
                    goBack();
                    break;

                case 'del':
                    switch($rol)
                    {
                        case 'EST':
                            $query = mysqli_query($conn, "DELETE FROM estudiantes WHERE ci_est = $ci");
                            break;
                        case 'DOC':
                            $query = mysqli_query($conn, "DELETE FROM docentes WHERE ci_doc = $ci");
                            break;
                        case 'ADM':
                            $query = mysqli_query($conn, "DELETE FROM administradores WHERE ci_adm = $ci");
                            break;
                    }
                    goBack();
                    break;
            }
        ?>
    </body>
    <script>
        function sendForm()
        {
            document.getElementById('areaGrid').submit();
        }

        function actualizarGrid() 
        {
            let grid = document.getElementById('areaGrid');
            let string = "repeat(";
            let a = "";
            let b = "";

            if((grid.childElementCount % 2) == 0) {
                if(grid.childElementCount >= 12)
                {
                    a = string.concat("3, 1fr)");
                    b = string.concat((Math.ceil(parseInt(grid.childElementCount) / 2)), ", 1fr)");

                    grid.style.gridTemplateRows = b;
                    grid.style.gridTemplateColumns = a;
                } else {
                    a = string.concat("2, 1fr)");
                    b = string.concat((Math.ceil(parseInt(grid.childElementCount) / 2)), ", 1fr)");

                    grid.style.gridTemplateRows = b;
                    grid.style.gridTemplateColumns = a;
                }
            } else {
                if(grid.childElementCount >= 7)
                {
                    if(grid.childElementCount <= 10)
                    {
                        numero = Math.ceil(parseInt(grid.childElementCount) / 2);

                        a = string.concat("2, 1fr)");

                        b = string.concat(numero, ", 1fr)", " repeat(", (grid.childElementCount - numero), ", max-content)");

                        grid.style.gridTemplateColumns = a;
                        grid.style.gridTemplateRows = b;
                    } else {
                        a = string.concat("3, 1fr)");
                        b = string.concat((Math.ceil(parseInt(grid.childElementCount) / 2)), ", 1fr)");

                        grid.style.gridTemplateRows = b;
                        grid.style.gridTemplateColumns = a;
                    }
                } else {
                    a = string.concat(grid.childElementCount, ", 1fr)");
                    grid.style.gridTemplateRows = a;
                }
            }
        }
    </script>
</html>