<html lang='es'>
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="img/logoIcon.svg">
        <title> TUF | PÁGINA PRINCIPAL </title>
        <link rel="stylesheet" href="css/login.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            $ci = $_POST['cedula'];
            $con = $_POST['contrasena'];
            $dbb_con = "";

            if($_POST['login'] == 1){
                if($_POST['logged'] == 0)
                {
                    if(($ci != '') && ($con != ''))
                    {
                        $sql = mysqli_connect("localhost", "root", $dbb_con);
                        $db = mysqli_select_db($sql, "tutorias");
    
                        $rol = "EST";
                        $query = mysqli_query($sql, "SELECT contrasena FROM estudiantes WHERE ci_est = $ci");
    
                        if($query->num_rows == 0) 
                        {
                            $query = mysqli_query($sql, "SELECT contrasena FROM docentes WHERE ci_doc = $ci");
                            $rol = "DOC";
    
                            if($query->num_rows == 0) 
                            {
                                $query = mysqli_query($sql, "SELECT contrasena FROM administradores WHERE ci_adm = $ci");
                                $rol = "ADM";
    
                                if($query->num_rows == 0) 
                                {
                                    echo("<script> alert('Esta cuenta es inexistente.') </script>");
    
                                    echo "<form method='post' action='index.php' id='myForm'>";
                                    echo "<script>"
                                        . "var varTimerInMiliseconds = 100;
                                            setTimeout(function(){ 
                                                document.getElementById('myForm').submit();
                                            }, varTimerInMiliseconds);"
                                        . "</script>";
                                    echo "</form>";
                                }
                            }
                        }
    
                        $result = mysqli_fetch_array($query);
    
                        if(password_verify($con, $result[0]))
                        {
                            setcookie("ci", $ci);
    
                            switch($rol)
                            {
                                case "EST":
                                    setcookie("rol", $rol);
                                    echo "<form method='post' action='inicioEst.php' id='myForm'>";
                                    echo "<script>"
                                        . "var varTimerInMiliseconds = 100;
                                            setTimeout(function(){ 
                                                document.getElementById('myForm').submit();
                                            }, varTimerInMiliseconds);"
                                        . "</script>";
                                    echo "</form>";
                                    break;
                                case "DOC":
                                    setcookie("rol", $rol);
                                    echo "<form method='post' action='inicioDoc.php' id='myForm'>";
                                    echo "<script>"
                                        . "var varTimerInMiliseconds = 100;
                                            setTimeout(function(){ 
                                                document.getElementById('myForm').submit();
                                            }, varTimerInMiliseconds);"
                                        . "</script>";
                                    echo "</form>";
                                    break;
                                case "ADM":
                                    setcookie("rol", $rol);
                                    echo "<form method='post' action='inicioAdm.php' id='myForm'>";
                                    echo "<script>"
                                        . "var varTimerInMiliseconds = 100;
                                            setTimeout(function(){ 
                                                document.getElementById('myForm').submit();
                                            }, varTimerInMiliseconds);"
                                        . "</script>";
                                    echo "</form>";
                                    break;
                            }
                        } else {
                            echo ("<script> alert('La contraseña es incorrecta.') </script>");
                            echo "<form method='post' action='index.php' id='myForm'>";
                            echo "<script>"
                                . "var varTimerInMiliseconds = 100;
                                    setTimeout(function(){ 
                                        document.getElementById('myForm').submit();
                                    }, varTimerInMiliseconds);"
                                . "</script>";
                            echo "</form>";
                        }
                    } else {
                        echo ("<script> alert('Ingrese todos sus datos.') </script>");
                        echo "<form method='post' action='index.php' id='myForm'>";
                        echo "<script>"
                            . "var varTimerInMiliseconds = 100;
                                setTimeout(function(){ 
                                    document.getElementById('myForm').submit();
                                }, varTimerInMiliseconds);"
                            . "</script>";
                        echo "</form>";
                    }
                } else {
                    switch($_COOKIE['rol'])
                    {
                        case "EST":
                            echo "<form method='post' action='inicioEst.php' id='myForm'>";
                            echo "<script>"
                                . "var varTimerInMiliseconds = 100;
                                    setTimeout(function(){ 
                                        document.getElementById('myForm').submit();
                                    }, varTimerInMiliseconds);"
                                . "</script>";
                            echo "</form>";
                            break;
                        case "DOC":
                            echo "<form method='post' action='inicioDoc.php' id='myForm'>";
                            echo "<script>"
                                . "var varTimerInMiliseconds = 100;
                                    setTimeout(function(){ 
                                        document.getElementById('myForm').submit();
                                    }, varTimerInMiliseconds);"
                                . "</script>";
                            echo "</form>";
                            break;
                        case "ADM":
                            echo "<form method='post' action='inicioAdm.php' id='myForm'>";
                            echo "<script>"
                                . "var varTimerInMiliseconds = 100;
                                    setTimeout(function(){ 
                                        document.getElementById('myForm').submit();
                                    }, varTimerInMiliseconds);"
                                . "</script>";
                            echo "</form>";
                            break;
                    }
                }
            } else {
                $nom = $_POST['nombre'];
                $ape = $_POST['apellido'];
                $tel = $_POST['telefono'];
                $dir = $_POST['direccion'];
                $ema = $_POST['email'];

                if(($ci != '') && ($nom != '') && ($ape != '') && ($tel != '') && ($dir != '') && ($ema != '') && ($con != ''))
                {
                    $sql = mysqli_connect("localhost", "root", $dbb_con);
                    $db = mysqli_select_db($sql, "tutorias");

                    try {
                        $query = $sql -> query("INSERT INTO `estudiantes` 
                        (`ci_est`, `nombre`, `apellido`, `direccion`, `email`, `contrasena`) 
                        VALUES
                        ('$ci', '$nom', '$ape', '$dir', '$ema', '" . password_hash($con, PASSWORD_DEFAULT) . "')");
                    } catch(Exception $e) {
                        echo("<script> alert('Esta cuenta ya existe.') </script>");
                        
                        echo "<form method='post' action='index.php' id='myForm'>";
                        echo "<script>"
                            . "var varTimerInMiliseconds = 100;
                                setTimeout(function(){ 
                                    document.getElementById('myForm').submit();
                                }, varTimerInMiliseconds);"
                            . "</script>";
                        echo "</form>";
                    }

                    $query2 = mysqli_query($sql, "INSERT INTO `telefonos`(`telefono`, `ci_estudiante`) VALUES ('$tel', (SELECT ci_est FROM `estudiantes` WHERE ci_est = $ci))");

                    echo "<form method='post' action='index.php' id='myForm'>";
                    echo "<script>"
                        . "var varTimerInMiliseconds = 100;
                            setTimeout(function(){ 
                                document.getElementById('myForm').submit();
                            }, varTimerInMiliseconds);"
                        . "</script>";
                    echo "</form>";
                } else {
                    echo ("<script> alert('Ingrese todos sus datos.') </script>");
                    echo "<form method='post' action='index.php' id='myForm'>";
                    echo "<script>"
                        . "var varTimerInMiliseconds = 100;
                            setTimeout(function(){ 
                                document.getElementById('myForm').submit();
                            }, varTimerInMiliseconds);"
                        . "</script>";
                    echo "</form>";
                }
            }
        ?>
    </body>
</html>