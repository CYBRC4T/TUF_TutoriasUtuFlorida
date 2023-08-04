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
    <body>
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
                    <i class="fa-solid fa-user" onclick="window.location.href = 'verPerfil.php'"></i>
                </div>
            </div>
        </nav>

        <div class="tutBanner">
            <div class="tutTitle">
                <p> Nombre de la materia </p>
            </div>
        </div>

        <div class="container">
            <div class="detalles">
                <div class="item">
                    <p> Profesor: <span> PLACEHOLDER </span> </p>
                </div>

                <div class="item">
                    <p> Salón: <span> 0 </span> </p>
                </div>

                <div class="item">
                    <p id="horario"> Horario: </p>
                    <p> Inicio: <span> 00:00 </span> </p>
                    <p> Final: <span> 00:00 </span> </p>
                </div>
            </div>

            <div class="detalles">
                <div class="item">
                    <p> Descripción: </p>
                </div>
                <div class="item">
                    <p id="desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in nisi finibus, ornare turpis et, molestie tellus. Phasellus lobortis suscipit metus sed fermentum. Quisque mollis sapien nec tellus fermentum dapibus. Phasellus mi sapien, ultricies ut dictum non, porta hendrerit lacus. Praesent et tortor vehicula, vehicula ante quis, tincidunt dui. Aenean sit amet malesuada lacus. Fusce ut laoreet est. Pellentesque at tellus quis eros varius varius. Aliquam vel venenatis ligula. Mauris dignissim arcu at dictum egestas. Integer ac ante dolor.

                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus pharetra lacus ex, a dictum urna pretium vitae. Etiam vitae sem gravida magna commodo commodo. Fusce id dictum elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec vestibulum pulvinar dui nec hendrerit. Suspendisse potenti. Aliquam fringilla orci ut malesuada vestibulum. Nunc tincidunt ut magna id rhoncus. Nulla non nunc elit. Maecenas consectetur eros libero, et gravida velit commodo eu. Maecenas varius, leo at vulputate auctor, felis ipsum tempor lectus, sed euismod felis velit dignissim justo. Sed justo odio, fermentum vel leo sit amet, sollicitudin ultricies lectus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque consectetur ultrices tortor, vel porta nisl bibendum id. Donec mollis eleifend ante, vel scelerisque ipsum fermentum eget.

                    Phasellus congue viverra sapien et malesuada. Vivamus faucibus nunc sed imperdiet venenatis. In ultricies neque eget rhoncus imperdiet. Nullam venenatis mauris ut velit porttitor elementum. Aliquam erat volutpat. Nullam vitae dolor velit. Suspendisse et cursus velit, sit amet convallis ante. Maecenas blandit, lorem quis faucibus pulvinar, nibh nunc venenatis risus, nec viverra leo justo quis metus. Nam ac elit libero. Vestibulum sodales turpis eu nibh porttitor iaculis. Praesent ac dolor nulla. Sed dapibus hendrerit magna, dignissim sollicitudin sem sagittis quis. Donec euismod arcu in justo ullamcorper laoreet.

                    Aenean eget sapien magna. Aenean vitae tristique risus. Sed placerat gravida lorem. Mauris suscipit massa tortor, eu auctor dolor aliquam vel. Ut elementum ut dolor eu vehicula. Maecenas condimentum nisi a orci semper, sed pretium ipsum blandit. Mauris a nibh nisi. Sed nec sapien lacus. Sed imperdiet dui cursus, rutrum velit a, euismod magna. Cras vel arcu quis lectus fermentum consequat nec a ligula. Sed vehicula feugiat lectus et sagittis. Proin semper aliquam enim eu fringilla.

                    Proin viverra ac est a fringilla. Suspendisse potenti. Vestibulum scelerisque volutpat porta. Maecenas et molestie dui, ut tempus tortor. Suspendisse at justo vel orci sagittis egestas. Etiam vitae ante non felis facilisis mattis at non arcu. Suspendisse justo enim, varius a posuere aliquam, aliquam quis lorem. Quisque gravida pulvinar felis, eget eleifend odio ultrices sit amet. Nam eget arcu at lectus blandit porta.

                    Sed molestie, ipsum non egestas ultricies, nulla tortor consectetur mi, ac gravida nisl risus at leo. Proin et ligula vel odio accumsan aliquam nec vel nisi. Integer erat sem, vestibulum at ullamcorper ut, sollicitudin sit amet metus. Sed ut dapibus nibh. Suspendisse vehicula felis mi, non tincidunt neque sagittis sed. Vestibulum facilisis venenatis mauris, in porttitor neque tempor ut. </p>
                </div>
            </div>
        </div>
        
        <div class="botones">
            <a href="inicioEst.php"> VOLVER </a>
            <a href="inicioEst.php"> UNIRSE </a>
        </div>

        <footer>
        </footer>
    </body>
        <script> 
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