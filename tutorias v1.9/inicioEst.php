<?php
    if(!isset($_COOKIE['ci']) || !isset($_COOKIE['rol']) || $_COOKIE['rol'] != "EST")
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
        <title> TUF | INICIO </title>
        <link rel="stylesheet" href="css/inicioAlu.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="notifHidden" id="notifMenu">
            <div class="custom-loader" id="loader"></div>
        </div>
        <div class="materiaClick" id="matMenu">
            <h2> ¿? </h2>
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
        
        <div class="sugHidden" id="menuSugerencia">
            <span> <i class="fa-solid fa-circle-xmark fa-lg" onclick="mostrarSugerencia()"></i> </span>
            <h1> ¡Envía tu solicitud! </h1>
            <hr>
            <div class="sugMenu">  
                <form>
                    <textarea id="texto" name="texto" placeholder="Por favor, incluye el nombre de la materia y de que año..."></textarea>
                    <input type='submit' value='ENVIAR'>
                </form>
                <img src="img/sugerenciaCC.png" />
            </div>
        </div>

        <div class="container">
            <div class="ventanas">
                <a id="boton" class="ventanas" onclick="toggleButton(this)" href="#"> TUTORÍAS </a>
                <a id="boton2" class="ventanas2" onclick="toggleButton(this)" href="#"> MATERIAS </a>
                <div class="filler"></div>
            </div>
            <div class="pageSwitch">
                <section class="tutorias">
                    <h1> Elige la tutoría en la que estés interesado: </h1>
                    <div class="grid">
                        <?php
                            $x = 0;
                            while($x != 4)
                            {
                                echo("<div class='item'> <a href='detalleTut.php'> ASIGNATURA </a> </div>");
                                $x++;
                            }
                        ?>
                    </div>
                    <h3> ¿No ves la tutoría que quieres? </h3>
                    <h3 id="verMas"> Has click <a href="listaTutorias.php"> aquí </a> para ver más, o <a href="#" onclick="mostrarSugerencia()"> aquí </a> para solicitarla</h3>
                </section>
                <section class="hidden">
                    
                </section>

                <aside>
                    <h4> Horarios </h4>
                    <hr>
                </aside>
            </div>
    </body>
    <footer>
        
    </footer>
    <script type="text/javascript">
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

        function mostrarSugerencia()
        {
            let element = document.getElementById('menuSugerencia');

            if(hasClass(element, "sugHidden")){
                removeClass(element, "sugHidden");
                addClass(element, "sugShown");
            } else {
                removeClass(element, "sugShown");
                addClass(element, "sugHidden");
            }
        }

        function toggleButton(btn) {
        
            let btn2 = document.getElementById("boton2");
            let x = hasClass(btn, "ventanas2");

            if(btn.id == "boton")
            {
                btn2 = document.getElementById("boton2");
                x = hasClass(btn, "ventanas2");
            } else {
                btn2 = document.getElementById("boton");
                x = hasClass(btn, "ventanas2");
            }

            if(x) {
                removeClass(btn, "ventanas2");
                addClass(btn, "ventanas");

                removeClass(btn2, "ventanas");
                addClass(btn2, "ventanas2");

                console.log(btn.className);
                console.log(btn2.className);
            }
        }
    </script>
</html>