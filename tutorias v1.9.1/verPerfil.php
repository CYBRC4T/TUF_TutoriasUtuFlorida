<?php
    if(!isset($_COOKIE['ci']) || !isset($_COOKIE['rol']))
    {
        unset($_COOKIE['ci']);
        unset($_COOKIE['rol']);
        setcookie('ci', '', time() - 3600);
        setcookie('rol', '', time() - 3600);

        echo ("<form action='index.php' method='post' id='myForm'>");
        echo ("<script>"
                . "var varTimerInMiliseconds = 100;
                    setTimeout(function(){ 
                        document.getElementById('myForm').submit();
                    }, varTimerInMiliseconds);"
                . "</script>");
        echo ("</form>");
    }
?>

<html lang='es'>
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="img/logoIcon.svg">
        <title> TUF | Perfil </title>
        <link rel="stylesheet" href="css/detalles.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="notifHidden" id="notifMenu">
            <div class="custom-loader" id="loader"></div>
        </div>

        <nav>
            <img src="img/utu.png"/>
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

        <div class="tutBanner" id="perfil"></div>

        <div class="pfp">
            <?php
                $sql = mysqli_connect("localhost", "root", "");
                mysqli_select_db($sql, "tutorias");

                $query = mysqli_query($sql, "SELECT count(ci_est) FROM estudiantes WHERE ci_est ='" . $_POST['perfCI'] . "'");
                $cantidad = mysqli_fetch_array($query);

                if($cantidad[0] != 0) {
                    $rol = "EST";
                } else {
                    $query = mysqli_query($sql, "SELECT count(ci_doc) FROM docentes WHERE ci_doc ='" . $_POST['perfCI'] . "'");
                    $cantidad = mysqli_fetch_array($query);

                    if($cantidad[0] != 0) {
                        $rol = "DOC";
                    } else {
                        $rol = "ADM";
                    }
                }

                if($rol == "EST")
                {
                    echo ("<img id='overlay' src='img/estOverlay.png' />");
                } else {
                    if($rol == "DOC")
                    {
                        echo ("<img id='overlay' src='img/docOverlay.png' />");
                    } else {
                        echo ("<img id='overlay' src='img/admOverlay.png' />");
                    }
                }

                $src = 'src';
                if(file_exists("archivos/pfp/" . $_POST['perfCI'] . ".jpg")) {
                    echo("<img src='archivos/pfp/" . $_POST['perfCI'] . ".jpg' onclick='seeImage(this)'/>");
                } else {
                    if(file_exists("archivos/pfp/" . $_POST['perfCI'] . ".jpeg")) {
                        echo("<img src='archivos/pfp/" . $_POST['perfCI'] . ".jpeg' onclick='seeImage(this)'/>");
                    } else {
                        if(file_exists("archivos/pfp/" . $_POST['perfCI'] . ".png")) {
                            echo("<img src='archivos/pfp/" . $_POST['perfCI'] . ".png' onclick='seeImage(this)'/>");
                        } else {
                            echo("<img src='archivos/pfp/pfpDefault.jpg' onclick='seeImage(this)'/>");
                        }
                    }
                }
                
                if($_POST['perfCI'] == $_COOKIE['ci'])
                {
                    echo("<form action='uploadManager.php' method='post' id='uploadForm' enctype='multipart/form-data'>");
                    echo("<label for='archivo'> CAMBIAR FOTO DE PERFIL </label>");
                    echo("<input type='file' id='archivo' name='archivo' accept='.jpg, .jpeg, .png' onchange='changePFP()'>");
                    echo("<input type='text' id='arcType' name='arcType' value='pfp'>");
                    echo("</form>");
                }
            ?>
        </div>

        <div class="fullimgBG" onclick="changePFP()" id="pfpBg"></div>
        <div class="pfpHidden" id="pfpMenu">
            <span> <i class="fa-solid fa-circle-xmark fa-lg" onclick="changePFP()"></i> </span>
            <h2> ¿Desea realizar el cambio? </h2>
            <h3> Luego podrá volver a cambiar su foto de perfil si así lo desea. </h3>
            <h3> (Se permiten archivos jpeg, jpg y png de hasta 5MB de espacio) </h3>
            <div class="btns">
                <a onclick="document.getElementById('uploadForm').submit()"> CONFIRMAR </a>
                <a onclick="changePFP()"> CANCELAR </a>
            </div>
        </div>

        <div class="fullimgBG" onclick="seeImage(null)" id="imgBg"></div>
        <div class="imageHidden" id="seeImage">
            <div class="closeButton" onclick="seeImage(null)"> <p> ✖ </p> </div>
            <img id="imagen" src=""/>
        </div>

        <div class="container" id="noBg">
            <div class="detalles" id="perfil">
                <div class="item">
                    <?php

                        switch($rol)
                        {
                            case 'EST':
                                echo("<span id='rolTXT'> Estudiante </span>");
                                break;
                            case 'DOC':
                                echo("<span id='rolTXT'> Docente </span>");
                                break;
                            case 'ADM':
                                echo("<span id='rolTXT'> Administrador </span>");
                                break;
                        }
                    ?>
                </div>

                <div class="item" id="nombre">
                    <p> Nombre: </p>
                    <?php 

                        switch($rol)
                        {
                            case 'EST':
                                $query2 = mysqli_query($sql, "SELECT nombre, apellido FROM estudiantes WHERE ci_est = " . $_POST['perfCI']);
                                break;
                            case 'DOC':
                                $query2 = mysqli_query($sql, "SELECT nombre, apellido FROM docentes WHERE ci_doc = " . $_POST['perfCI']);
                                break;
                            case 'ADM':
                                $query2 = mysqli_query($sql, "SELECT nombre, apellido FROM administradores WHERE ci_adm = " . $_POST['perfCI']);
                                break;
                        }

                        $nombre = mysqli_fetch_array($query2);
                        $nombre = array($nombre[0], $nombre[1]);
                        $nombre = implode(" ", $nombre);
                        echo("<span>" . $nombre . "</span>");
                    ?>
                </div>

                <div class="item" id="descTitle">
                    <p> Biografía: </p>
                </div>
                <div class="item" id="desc">
                    <p id="desc2"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in nisi finibus, ornare turpis et, molestie tellus. Phasellus lobortis suscipit metus sed fermentum. Quisque mollis sapien nec tellus fermentum dapibus. Phasellus mi sapien, ultricies ut dictum non, porta hendrerit lacus. Praesent et tortor vehicula, vehicula ante quis, tincidunt dui. Aenean sit amet malesuada lacus. Fusce ut laoreet est. Pellentesque at tellus quis eros varius varius. Aliquam vel venenatis ligula. Mauris dignissim arcu at dictum egestas. Integer ac ante dolor.

                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pharetra lacus ex, a dictum urna pretium vitae. Etiam vitae sem gravida magna commodo commodo. Fusce id dictum elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec vestibulum pulvinar dui nec hendrerit. Suspendisse potenti. Aliquam fringilla orci ut malesuada vestibulum. Nunc tincidunt ut magna id rhoncus. Nulla non nunc elit. Maecenas consectetur eros libero, et gravida velit commodo eu. Maecenas varius, leo at vulputate auctor, felis ipsum tempor lectus, sed euismod felis velit dignissim justo. Sed justo odio, fermentum vel leo sit amet, sollicitudin ultricies lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque consectetur ultrices tortor, vel porta nisl bibendum id. Donec mollis eleifend ante, vel scelerisque ipsum fermentum eget.

                    Phasellus congue viverra sapien et malesuada. Vivamus faucibus nunc sed imperdiet venenatis. In ultricies neque eget rhoncus imperdiet. Nullam venenatis mauris ut velit porttitor elementum. Aliquam erat volutpat. Nullam vitae dolor velit. Suspendisse et cursus velit, sit amet convallis ante. Maecenas blandit, lorem quis faucibus pulvinar, nibh nunc venenatis risus, nec viverra leo justo quis metus. Nam ac elit libero. Vestibulum sodales turpis eu nibh porttitor iaculis. Praesent ac dolor nulla. Sed dapibus hendrerit magna, dignissim sollicitudin sem sagittis quis. Donec euismod arcu in justo ullamcorper laoreet.

                    Aenean eget sapien magna. Aenean vitae tristique risus. Sed placerat gravida lorem. Mauris suscipit massa tortor, eu auctor dolor aliquam vel. Ut elementum ut dolor eu vehicula. Maecenas condimentum nisi a orci semper, sed pretium ipsum blandit. Mauris a nibh nisi. Sed nec sapien lacus. Sed imperdiet dui cursus, rutrum velit a, euismod magna. Cras vel arcu quis lectus fermentum consequat nec a ligula. Sed vehicula feugiat lectus et sagittis. Proin semper aliquam enim eu fringilla.

                    Proin viverra ac est a fringilla. Suspendisse potenti. Vestibulum scelerisque volutpat porta. Maecenas et molestie dui, ut tempus tortor. Suspendisse at justo vel orci sagittis egestas. Etiam vitae ante non felis facilisis mattis at non arcu. Suspendisse justo enim, varius a posuere aliquam, aliquam quis lorem. Quisque gravida pulvinar felis, eget eleifend odio ultrices sit amet. Nam eget arcu at lectus blandit porta.

                    Sed molestie, ipsum non egestas ultricies, nulla tortor consectetur mi, ac gravida nisl risus at leo. Proin et ligula vel odio accumsan aliquam nec vel nisi. Integer erat sem, vestibulum at ullamcorper ut, sollicitudin sit amet metus. Sed ut dapibus nibh. Suspendisse vehicula felis mi, non tincidunt neque sagittis sed. Vestibulum facilisis venenatis mauris, in porttitor neque tempor ut. </p>
                </div>
            </div>

            <div class="detalles" id="perfil">
                <div class="item">
                    <p id="titulo"> Tutorías </p>
                </div>
                <div class="tableBorder">
                    <?php
                        if(($_COOKIE['rol'] == 'DOC') || ($_COOKIE['rol'] == 'ADM')) 
                        {
                            $q_tutos = mysqli_query($sql, "SELECT tutorias.id_tut AS id, materias.nombre AS materia FROM tutorias, materias WHERE materias.id_mat = tutorias.materia AND tutorias.docente = " . $_POST['perfCI']);
                            $q_tutos2 = mysqli_query($sql, "SELECT count(tutorias.id_tut), materias.nombre FROM tutorias, materias WHERE materias.id_mat = tutorias.materia AND tutorias.docente = " . $_POST['perfCI']);
                            $cant_tutos = mysqli_fetch_array($q_tutos2);

                            if($cant_tutos[0] != 0)
                            {
                                echo("<table>");

                                if($rol == 'EST')
                                {
                                    echo("<th> Tutorias </th>");
                                    echo("<th> Inasistencias </th>");
                                    
                                    for($x = 0; $x < 20; $x++)
                                    {
                                        echo("<tr> <td> MATERIA </td> <td> 0 </td> </tr>");
                                    }
                                } else {
                                    echo("<th> ID </th>");
                                    echo("<th> Nombre </th>");

                                    while($tuto = mysqli_fetch_assoc($q_tutos))
                                    {
                                        echo("<tr id='prof'> <td>" . $tuto['id'] . "</td> <td onclick='entrarMateria(" . $tuto['id'] . ")'>" . $tuto['materia'] . "</td> </tr>");
                                    }
                                }
                                echo("</table>");
                            } else {
                                echo("<p> No existen tutorías de este docente. </p>");
                            }
                        } else {
                            $q_tutos = mysqli_query($sql, "SELECT tutorias.id_tut AS id, materias.nombre AS materia FROM tutorias, materias WHERE materias.id_mat = tutorias.materia AND tutorias.docente = " . $_POST['perfCI']);
                            $q_tutos2 = mysqli_query($sql, "SELECT count(tutorias.id_tut), materias.nombre FROM tutorias, materias WHERE materias.id_mat = tutorias.materia AND tutorias.docente = " . $_POST['perfCI']);
                            $cant_tutos = mysqli_fetch_array($q_tutos2);

                            if($cant_tutos[0] != 0)
                            {
                                echo("<table>");

                                if($rol == 'EST')
                                {
                                    echo("<th> Tutorias </th>");
                                    echo("<th> Inasistencias </th>");
                                    
                                    for($x = 0; $x < 20; $x++)
                                    {
                                        echo("<tr> <td> MATERIA </td> <td> 0 </td> </tr>");
                                    }
                                } else {
                                    echo("<th> ID </th>");
                                    echo("<th> Nombre </th>");

                                    while($tuto = mysqli_fetch_assoc($q_tutos))
                                    {
                                        echo("<tr id='prof'> <td>" . $tuto['id'] . "</td> <td onclick='entrarMateria(" . $tuto['id'] . ")'>" . $tuto['materia'] . "</td> </tr>");
                                    }
                                }
                                echo("</table>");
                            } else {
                                echo("<p> No existen tutorías de este docente. </p>");
                            }
                        }
                    ?>
                    </table>
                </div>
                <form class="hidden" action="detalleTut.php" method="post" id="matForm">
                    <?php 
                        echo("<input type='text' name='id_tut' id='id_tut' value=''>");
                    ?>
                </form>
            </div>
            <a id="perfbtn" onclick="window.history.back()"> VOLVER </a>
        </div>
    </body>
        <script>
            function entrarMateria(id)
            {
                document.getElementById('id_tut').value = id;

                document.getElementById('matForm').submit();
            }

            function changePFP() 
            {
                let element = document.getElementById('pfpMenu');
                let fondo = document.getElementById('pfpBg')

                if(hasClass(element, "pfpHidden")){
                    removeClass(element, "pfpHidden");
                    addClass(element, "pfpShown");

                    removeClass(fondo, "imgBgHidden");
                    addClass(fondo, "imgBgShow");

                    imagen.src = pfp;
                } else {
                    removeClass(element, "pfpShown");
                    addClass(element, "pfpHidden");

                    removeClass(fondo, "imgBgShow");
                    addClass(fondo, "imgBgHidden");
                }
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
                let fondo = document.getElementById('imgBg');

                if(screen.width >= 768)
                if(hasClass(element, "imageHidden")){
                    removeClass(element, "imageHidden");
                    addClass(element, "imageShow");

                    removeClass(fondo, "imgBgHidden");
                    addClass(fondo, "imgBgShow");

                    imagen.src = pfp.src;
                } else {
                    removeClass(element, "imageShow");
                    addClass(element, "imageHidden");

                    removeClass(fondo, "imgBgShow");
                    addClass(fondo, "imgBgHidden");
                }
            }
        </script>
</html>