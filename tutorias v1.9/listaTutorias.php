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

                <select onchange='this.blur()' onmouseleave="this.blur()">
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

                <select onchange='this.blur()' onmouseleave="this.blur()">
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

                <select onchange='this.blur()' onmouseleave="this.blur()">
                    <option> Salón... </option>
                    <?php
                        $query = mysqli_query($conn, "SELECT salon FROM tutorias");

                        if($query)
                        {
                            while($row = mysqli_fetch_assoc($query))
                            {
                                echo("<option value='". $row["salon"] ."'>" . $row["salon"] . "</div>");
                            }
                        }
                    ?>
                </select>

                <input type="date" id="text" name="text">
                <input type="time" id="text" name="text">
                <input type="time" id="text" name="text">

            </form>

            <div class="lista">
                <div class='tutoria'> <p> ID </p> 
                    <p> MATERIA </p> 
                    <p> DOCENTE </p>
                    <p> SALÓN </p>
                    <p> ÁREA </p>
                    <p> FECHA </p>
                    <p> HORA DE INICIO </p>
                    <p> HORA FINAL </p>
                    <p>  </p>
                </div>
                
                <?php
                    $query = mysqli_query($conn, 
                    "SELECT tutorias.id_tut AS id_tut, materias.nombre AS materia, tutorias.docente AS ci_doc,
                    docentes.nombre AS docente, tutorias.salon AS salon, tutorias.area AS area,
                    tutorias.fecha AS fecha, tutorias.hora_inicio AS hora_inicio, tutorias.hora_final AS hora_final,
                    tutorias.descripcion AS descripcion FROM tutorias, docentes, materias WHERE tutorias.docente = docentes.ci_doc AND tutorias.materia = materias.id_mat");

                    if($query)
                    {
                        while($row = mysqli_fetch_assoc($query))
                        {
                            echo("<div class='tutoria'> <p>" . $row["id_tut"] . "</p> 
                            <p>" . $row["materia"] . "</p> 
                            <a onclick='verPerfil(" . strval($row['ci_doc']) . ")'>" . $row["docente"] . "</a>
                            <p>" . $row["salon"] . "</p>
                            <p>" . $row["area"] . "</p>
                            <p>" . $row["fecha"] . "</p>
                            <p>" . $row["hora_inicio"] . "</p>
                            <p>" . $row["hora_final"] . "</p>
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