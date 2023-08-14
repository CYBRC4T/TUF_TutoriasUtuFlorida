<html>
    <head>
        <title> TUF | Preparar Tutoría </title>
    </head>
    <body>
    </body>
</html>
<?php
    $conn = mysqli_connect("localhost", "root", "");
    $dbb = mysqli_select_db($conn, "tutorias");

    $query = mysqli_query($conn, "SELECT count(id_tut) FROM tutorias");
    $result = mysqli_fetch_array($query);
                    
    echo($_POST['materia']);
    $query2 = mysqli_query($conn, "SELECT id_mat FROM materias WHERE nombre = '" . $_POST['materia'] . "'");
    $result2 = mysqli_fetch_array($query2);

    $query3 = mysqli_query($conn, "INSERT INTO 
    `tutorias`(`id_tut`, `materia`, `docente`, `fecha_creacion`, `area`, `descripcion`) 
    VALUES ('" . $result[0] . "','" . $result2[0] . "','" . $_COOKIE['ci'] . "','" . date('d-m-Y H:i:s') . "','" . $_POST['area'] . "','" . $_POST['desc'] . "')");

    $x = 0;

    while($x != $_POST['dias'])
    {

    }

    echo ("<form action='inicioDoc.php' method='post' id='myForm'>");
    echo ("<script>"
            . "var varTimerInMiliseconds = 100;
                setTimeout(function(){ 
                    document.getElementById('myForm').submit();
                }, varTimerInMiliseconds);"
            . "</script>");
    echo ("</form>");
?>