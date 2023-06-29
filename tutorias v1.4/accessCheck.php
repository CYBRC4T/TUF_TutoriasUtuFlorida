<html lang='es'>
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="img/logo.png">
        <title> TUF | PÁGINA PRINCIPAL </title>
        <link rel="stylesheet" href="css/login.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            $ci = $_POST['cedula'];
            $con = $_POST['contrasena'];

            if($_POST['login'] == 1){
                if(($ci != '') && ($con != ''))
                {
                    $sql = mysqli_connect("localhost", "root", "cybercat!2023");
                    $db = mysqli_select_db($sql, "bdd_tutorias");

                    $rol = "EST";
                    $query = mysqli_query($sql, "SELECT contrasena FROM alumnos WHERE ci = $ci");

                    if($query->num_rows == 0) 
                    {
                        $query = mysqli_query($sql, "SELECT contrasena FROM docentes WHERE ci = $ci");
                        $rol = "DOC";

                        if($query->num_rows == 0) 
                        {
                            $query = mysqli_query($sql, "SELECT contrasena FROM administradores WHERE ci = $ci");
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
                        switch($rol){
                            case "EST":
                                echo "<form method='post' action='inicioAlu.php' id='myForm'>";
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
                $nom = $_POST['nombre'];
                $ape = $_POST['apellido'];
                $tel = $_POST['telefono'];
                $dir = $_POST['direccion'];
                $ema = $_POST['email'];

                if(($ci != '') && ($nom != '') && ($ape != '') && ($tel != '') && ($dir != '') && ($ema != '') && ($con != ''))
                {
                    $sql = mysqli_connect("localhost", "root", "cybercat!2023");
                    $db = mysqli_select_db($sql, "bdd_tutorias");

                    $query = mysqli_query($sql, "INSERT INTO `alumnos` 
                    (`ci`, `nombre`, `apellido`, `telefono`, `direccion`, `contrasena`, `email`) 
                    VALUES
                    ('$ci', '$nom', '$ape', '$tel', '$dir','" . password_hash($con, PASSWORD_DEFAULT) . "', '$ema')");
                    
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