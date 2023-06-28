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
            $nom = $_POST['nombre'];
            $ape = $_POST['apellido'];
            $tel = $_POST['telefono'];
            $dir = $_POST['direccion'];
            $ema = $_POST['email'];
            $con = $_POST['contrasena'];

            if(($ci != '') && ($nom != '') && ($ape != '') && ($tel != '') && ($dir != '') && ($ema != '') && ($con != ''))
            {

                $sql = mysqli_connect("localhost", "root", "cybercat!2023");
                $db = mysqli_select_db($sql, "bdd_tutorias");

                $query = mysqli_query($sql, "INSERT INTO `alumnos` 
                (`ci`, `nombre`, `apellido`, `telefono`, `direccion`, `contrasena`, `email`) 
                VALUES
                ('$ci', '$nom', '$ape', '$tel', '$dir','" . password_hash($con, PASSWORD_DEFAULT) . "', '$ema')");
                
                echo ("<script> alert('Listo.') </script>");
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
        ?>
    </body>
</html>