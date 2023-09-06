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
        <title> TUF | Lista de Tutorías </title>
        <link rel="stylesheet" href="css/lista.css">

        <script src="js/classManager.js"> </script>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav>
            <img src="img/utu.png">
            <div class="divisor"></div>
            <p> Tutorias UTU Florida </p>

            <blank>

            <div class="navIcons">
                <div class="backDoor">
                    <i class="fa-sharp fa-solid fa-door-open" onclick="window.location.href = 'cerrarSesion.php'"></i>
                    <h4> SALIR </h4>
                </div>
                
                <div class="notif">
                    <i class="fa-solid fa-bell" onclick="showNotif()"></i>
                    <div class="notis">
                        <p> 1 </p>
                    </div>
                </div>

                <div class="perfil">
                    <h4> PERFIL </h4>
                    <form action="verPerfil.php" method="post" id="perfForm">
                        <?php echo("<input type='number' name='perfCI' id='perfCI' value='" . $_COOKIE['ci'] . "'>"); ?>
                    </form>
                    <i class="fa-solid fa-user" onclick="document.getElementById('perfForm').submit()"></i>
                </div>
            </div>
        </nav>

        <div class="container">
            <form class="filtros" action="listaTutorias.php" method="post">

                <!-- Barra de búsqueda -->
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                    <input placeholder="Ingresa la ID de la tutoría..." type="search" id="search" name="search">
                </div>

                <select id='materia' name='materia' onchange='this.blur()' onmouseleave="this.blur()">
                    <option> Materia... </option>
                    <?php
                        $conn = mysqli_connect("localhost", "root", "");
                        $dbb = mysqli_select_db($conn, "tutorias");

                        $query = mysqli_query($conn, "SELECT id_mat, nombre FROM materias");

                        if($query)
                        {
                            while($row = mysqli_fetch_assoc($query))
                            {
                                echo("<option value='". $row["id_mat"] ."'>" . $row["nombre"] . "</div>");
                            }
                        }
                    ?>
                </select>

                <select id='area' name='area' onchange='this.blur()' onmouseleave="this.blur()">
                    <option> Área... </option>
                    <?php
                        $query = mysqli_query($conn, "SELECT area FROM materias GROUP BY area");

                        if($query)
                        {
                            while($row = mysqli_fetch_assoc($query))
                            {
                                echo("<option value='". $row["area"] ."'>" . $row["area"] . "</div>");
                            }
                        }
                    ?>
                </select>
                
                <input type='submit' value='APLICAR FILTROS'>
            </form>

            <div class="lista">
                <div class='tutoria'> 
                    <p> ID </p> 
                    <p> MATERIA </p> 
                    <p> DOCENTE </p>
                    <p> ÁREA </p>
                    <p> VER MÁS </p>
                </div>
                
                <?php
                    $q = "SELECT tutorias.id_tut AS id_tut, materias.nombre AS materia, tutorias.docente AS ci_doc,
                    docentes.nombre AS docente, tutorias.area AS area FROM tutorias, docentes, materias WHERE
                    tutorias.docente = docentes.ci_doc AND tutorias.materia = materias.id_mat";
                    $q2 = "SELECT count(id_tut) FROM tutorias, docentes, materias WHERE
                    tutorias.docente = docentes.ci_doc AND tutorias.materia = materias.id_mat";

                    if((isset($_POST['search'])) && ($_POST['search'] != ""))
                    {
                        $u = " AND tutorias.id_tut = " . $_POST['search'];
                    } else {
                        $u = "";
                    }
                    if((isset($_POST['materia'])) && ($_POST['materia'] != "Materia..."))
                    {
                        $e = " AND tutorias.materia = " . $_POST['materia'];
                    } else {
                        $e = "";
                    }
                    if((isset($_POST['area'])) && ($_POST['area'] != "Área..."))
                    {
                        $r = " AND tutorias.area = " . $_POST['area'];
                    } else {
                        $r = "";
                    }

                    $y = " ORDER BY id_tut";

                    $queryStr = (implode("", array($q, $u, $e, $r, $y)));
                    $query2Str = (implode("", array($q2, $u, $e, $r, $y)));

                    $query = mysqli_query($conn, $queryStr);
                    $query2 = mysqli_query($conn, $query2Str);
                    $result2 = mysqli_fetch_array($query2);

                    if(($query) && ($result2[0] >= 1))
                    {
                        while($row = mysqli_fetch_assoc($query))
                        {
                            echo("<div class='tutoria'> <p>" . $row["id_tut"] . "</p> 
                            <p>" . $row["materia"] . "</p> 
                            <a onclick='verPerfil(" . strval($row['ci_doc']) . ")'>" . $row["docente"] . "</a>
                            <p>" . $row["area"] . "</p>
                            <a onclick='verTutoria(" . strval($row['id_tut']) . ")'> VER DETALLES </a>
                            </div>");
                        }
                    } else {
                        echo("<p class='tutp'> No se encontraron tutorías...");
                    }

                    echo("<form class='hidden' action='verPerfil.php' method='post' id='perfForm'>");
                        echo("<input type='hidden' id='perfCI' name='perfCI' value=''>");
                    echo("</form>");

                    echo("<form class='hidden' action='detalleTut.php' method='post' id='tutForm'>");
                        echo("<input type='text' id='id_tut' name='id_tut' value='1'>");
                    echo("</form>");
                ?>
            </div>
        </div>
        <?php
            switch($_COOKIE['rol']) {
                case 'EST':
                    echo("<a class='volver' href='inicioEst.php'> VOLVER </a>");
                    break;
                case 'DOC':
                    echo("<a class='volver' href='inicioDoc.php'> VOLVER </a>");
                    break;
                case 'ADM':
                    echo("<a class='volver' href='inicioAdm.php'> VOLVER </a>");
                    break;
            }
        ?>
        <footer>

        </footer>
    </body>
    <script>
        function verTutoria(id) {
            document.getElementById('id_tut').value = id;
            document.getElementById('tutForm').submit();
        }

        function verPerfil(ci_doc) {
            document.getElementById('perfCI').value = ci_doc;
            document.getElementById('perfForm').submit();
        }
    </script>
</html>