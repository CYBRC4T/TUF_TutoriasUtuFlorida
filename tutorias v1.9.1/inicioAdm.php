<?php
    if(!isset($_COOKIE['ci']) || !isset($_COOKIE['rol'])  || $_COOKIE['rol'] != "ADM")
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
        <title> TUF | Inicio </title>
        <link rel="stylesheet" href="css/inicioAlu.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    </head>
    <body onload="actualizarGrid()">
        <nav>
            <img src="img/utu.png">
            <div class="divisor"></div>
            <p> Tutorias UTU Florida </p>

            <blank>
            
            <div class="navIcons">
                <div class="backdoor">
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
                    <i class="fa-solid fa-user" onclick="document.getElementById('perfForm').submit()"></i>
                    <h4> PERFIL </h4>
                    <form action="verPerfil.php" method="post" id="perfForm" class="hidden">
                        <?php echo("<input type='number' name='perfCI' id='perfCI' value='" . $_COOKIE['ci'] . "'>"); ?>
                    </form>
                </div>
            </div>
        </nav>

        <div></div>

        <div class="container">
            <div class="ventanas">
                <a id="boton" class="ventanas" onclick="toggleButton(this)" href="#"> ADMINISTRAR TUTORÍAS </a>
                <a id="boton2" class="ventanas2" onclick="toggleButton(this)" href="#"> ADMINISTRAR USUARIOS </a>
                <div class="filler"></div>
            </div>
            <div class="pageSwitch">
                <section class="tutorias" id="tuto">
                    <h1> Estas son las tutorías creadas: </h1>
                    <div class="grid" id="tutosGrid">
                        <?php
                            $conn = mysqli_connect("localhost", "root", "");
                            $dbb = mysqli_select_db($conn, "tutorias");
                            $i = 0;

                            $query = mysqli_query($conn, "SELECT tutorias.id_tut AS id, materias.nombre AS Materia
                            FROM tutorias, materias WHERE tutorias.materia = materias.id_mat");
                            
                            $query2 = mysqli_query($conn, "SELECT count(id_tut) FROM tutorias");
                            $cantidad = mysqli_fetch_array($query2)[0];

                            if($cantidad != 0)
                            {
                                while(($row = mysqli_fetch_assoc($query)) && ($i != 9))
                                {
                                    echo("<div class='item'> <a onclick='editarMateria(" . $row["id"] . ',"' . $row["Materia"] . '"' . "); accionTuto(" . $row["id"] . ", 0)'>" . $row["Materia"] . "</a> </div>");
                                    $i++;
                                }
                            } else {
                                echo("<p> Aún no hay tutorías... </p>");
                            }
                        ?>
                    </div>

                    <form class="hidden" action="detalleTut.php" method="post" id="matForm">
                        <?php 
                            echo("<input type='text' name='id_tut' id='id_tut' value=''>");
                        ?>
                    </form>

                    <form class="hidden" action="subirTutoria.php" method="post" id="tutoForm">
                        <?php 
                            echo("<input type='text' name='switch' id='switch' value='0'>");
                            echo("<input type='text' name='id_tuto' id='id_tuto' value=''>");
                            echo("<input type='text' name='accion' id='accion' value=''>");
                        ?>
                    </form>
                </section>
                <section class="hidden" id="mate">
                    <form action="actUsuario.php" method="post" id="actUserForm">                        
                        <div class="item"> 
                            <label for="cuenta"> Cuenta: </label>
                            <select id="cuenta" name="cuenta" onchange='this.blur()' onmouseleave="this.blur()">
                                <option value='default'> Selecciona una cuenta: </option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT * FROM `estudiantes`");
                                    $query2 = mysqli_query($conn, "SELECT * FROM `docentes`");
                                    $query3 = mysqli_query($conn, "SELECT * FROM `administradores`");

                                    while($row = mysqli_fetch_assoc($query))
                                    {
                                        echo("<option value='" . $row['ci_est'] . "_EST'>" . $row["nombre"] . "</option>");
                                    }
                                    while($row = mysqli_fetch_assoc($query2))
                                    {
                                        echo("<option value='" . $row['ci_doc'] . "_DOC'>" . $row["nombre"] . "</option>");
                                    }
                                    while($row = mysqli_fetch_assoc($query3))
                                    {
                                        echo("<option value='" . $row['ci_adm'] . "_ADM'>" . $row["nombre"] . "</option>");
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="item">
                            <label for="type"> Acción: </label>
                            <select name="type" id="type" oninput="mostrarOpcion(this)">
                                <option value="default"> Selecciona una opción: </option>
                                <option value="est"> Hacer Estudiante </option>
                                <option value="doc"> Hacer Docente </option>
                                <option value="adm"> Hacer Administrador </option>
                                <option value="con"> Cambiar Contraseña </option>
                                <option value="del"> Eliminar Cuenta </option>
                            </select>
                        </div>

                        <div class="hidden" id="areasDiv">
                            <label for="areas"> Áreas: </label>
                            <select class="js-example-basic-multiple" name="areas[]" multiple="multiple" id="select_mul">
                                <?php 
                                    $query = mysqli_query($conn, "SELECT area FROM areas");
                                    
                                    while($result = mysqli_fetch_array($query))
                                    {
                                        echo("<option value='" . $result[0] . "'>" . $result[0] . "</option>");
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="hidden" id="contraDiv">
                            <label for="contra"> Contraseña nueva: </label>
                            <input type="password" name="contra" id="contra">
                        </div>

                        <input type="submit" onclick="event.preventDefault(); 
                        if((document.getElementById('cuenta').value != 'default')
                        && (document.getElementById('type').value != 'default')) { 
                            document.getElementById('actUserForm').submit() 
                        } else { alert('Asegurese de seleccionar cuenta y acción.') }" value="ACTUALIZAR CUENTA">
                    </form>
                </section>

                <aside id='menuAdm'>
                    <h4> Menú de edición </h4>
                    <hr>
                    <h2> Nombre: <span id='tutNom'> Elige una tutoría </span> </h2>
                    <br>

                    <div class="grid" id="tutoAcciones">
                        <h2> ¿Qué desea hacer con ésta tutoría? </h2>
                        <div class="item">
                            <a onclick="accionTuto(document.getElementById('tutNom').innerHTML, 1)"> Ver la tutoría </a>
                            <a onclick="accionTuto(document.getElementById('tutNom').innerHTML, 2)"> Editar la tutoría </a>
                            <a onclick="accionTuto(document.getElementById('tutNom').innerHTML, 3)"> Eliminar la tutoría </a>
                        </div>
                    </div>
                </aside>
        </div>
        
        <footer>
        </footer>
    </body>
    <script type="text/javascript">
        function toggleTut()
        {

        }

        function actualizarGrid() 
        {
            let grid = document.getElementById('tutosGrid');
            let string = "repeat(";
            let a = "";
            let b = "";

            if(grid.childElementCount > 3) {
                a = string.concat("3, 1fr)");
                b = string.concat((Math.ceil(parseInt(grid.childElementCount) / 3)), ", min-content)");

                grid.style.gridTemplateRows = b;
            } else {
                a = string.concat(grid.childElementCount, ", 1fr)");
            }

            grid.style.gridTemplateColumns = a;
        }

        function mostrarOpcion(select)
        {
            let areas = document.getElementById('areasDiv');
            let contra = document.getElementById('contraDiv');

            if(select.options[select.selectedIndex].value == "doc") {
                removeClass(areas, "hidden");
                addClass(areas, "item");
            } else {
                removeClass(areas, "item");
                addClass(areas, "hidden");
            }

            if(select.options[select.selectedIndex].value == "con") {
                removeClass(contra, "hidden");
                addClass(contra, "item");
            } else {
                removeClass(contra, "item");
                addClass(contra, "hidden");
            }
        }

        function editarMateria(id, materia)
        {
            let obj = document.getElementById('tutNom');
            obj.setAttribute("value", id);
            obj.innerHTML = materia;
            console.log(obj.getAttribute('innerHTML'));
        }

        function accionTuto(id, accion)
        {
            console.log(id);

            if(id !== ' Elige una tutoría ')
            {
                switch(accion)
                {
                    case 0:
                        document.getElementById('id_tut').value = id;
                        document.getElementById('id_tuto').value = id;
                        break;
                    case 1:
                        document.getElementById('matForm').submit();
                        break;
                    case 2:
                        document.getElementById('accion').value = 0;
                        document.getElementById('tutoForm').submit();
                        break;
                    case 3:
                        document.getElementById('accion').value = 1;
                        document.getElementById('tutoForm').submit();
                        break;
                }
            } else {
                alert("Debe elegir una tutoría primero.");
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
            let tuto = document.getElementById("tuto");
            let mate = document.getElementById("mate");
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
                
                if(hasClass(tuto, "hidden"))
                {
                    removeClass(tuto, "hidden");
                    addClass(tuto, "tutorias");

                    removeClass(mate, "materias");
                    addClass(mate, "hidden");
                } else {
                    removeClass(tuto, "tutorias");
                    addClass(tuto, "hidden");

                    removeClass(mate, "hidden");
                    addClass(mate, "materias");
                }
            }
        }

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({ });
        });
    </script>
</html>