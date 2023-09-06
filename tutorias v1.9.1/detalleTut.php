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
        <title> TUF | Detalles </title>
        <link rel="stylesheet" href="css/detalles.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body id='det'>
        <div class="notifHidden" id="notifMenu">
            <div class="custom-loader" id="loader"></div>
        </div>

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

        <?php
            $conn = mysqli_connect("localhost", "root", "");
            $dbb = mysqli_select_db($conn, "tutorias");
                    
            $query = mysqli_query($conn, "SELECT tutorias.id_tut, materias.nombre AS materia, docentes.nombre AS docente, 
            tutorias.area, tutorias.docente FROM tutorias, docentes, administradores, materias WHERE tutorias.id_tut = " . 
            $_POST['id_tut'] . " AND ((tutorias.docente = docentes.ci_doc) OR (tutorias.docente = administradores.ci_adm)) AND 
            tutorias.materia = materias.id_mat");

            $result = mysqli_fetch_array($query);
        ?>

        <div class="tutBanner">
            <div class="tutTitle">
            <?php echo("<p>" . $result[1] . "</p>") ?>
            </div>
        </div>

        <div class="container">
            <div class="detalles">
                <div class="item">
                    <p> Docente: <?php echo("<span onclick='verPerfil(" . strval($result['4']) . ")'>" . $result[2] . "</span>") ?> </p>
                    <?php
                        echo("<form class='hidden' action='verPerfil.php' method='post' id='perfForm'>");
                            echo("<input type='hidden' id='perfCI' name='perfCI' value=''>");
                        echo("</form>");
                    ?>
                </div>

                <div class="item">
                    <p> Area: <?php echo("<span>" . $result[3] . "</span>") ?> </p>
                </div>

            </div>

            <div class="detalles">
            </div>
        </div>
        
        <div class="botones">
            <?php
                if($_COOKIE['rol'] == 'EST')
                {
                    echo("<a href='inicioEst.php' > UNIRSE </a>");
                }

                echo("<a onclick='window.history.back()'> VOLVER </a>");

                if($result[4] == $_COOKIE['ci'])
                {
                    echo("<a href='inicioEst.php'> SUBIR ARCHIVOS A TUTORÍA </a>");
                    
                    unset($_COOKIE['tut_id']);
                    setcookie('tut_id', $result[0], time() - 3600);
                }
            ?>
        </div>

        <footer>
        </footer>
    </body>
        <script> 
            function verPerfil(ci) {
                document.getElementById('perfCI').value = ci;
                document.getElementById('perfForm').submit();
            }

            function showNotif()
            {
                let element = document.getElementById('notifMenu');

                if(hasClass(element, "notifHidden")){
                    removeClass(element, "notifHidden");
                    addClass(element, "notifShow");
                } else {
                    removeClass(element, "notifShow");
                    addClass(element, "notifHidden");
                }
            }

            function seeImage(pfp)
            {
                let element = document.getElementById('seeImage');
                let imagen = document.getElementById('imagen');
                let fondo = document.getElementById('imgBg')

                if(hasClass(element, "imageHidden")){
                    removeClass(element, "imageHidden");
                    addClass(element, "imageShow");

                    removeClass(fondo, "imgBgHidden");
                    addClass(fondo, "imgBgShow");

                    imagen.src = pfp;
                } else {
                    removeClass(element, "imageShow");
                    addClass(element, "imageHidden");

                    removeClass(fondo, "imgBgShow");
                    addClass(fondo, "imgBgHidden");
                }
            }
        </script>
</html>