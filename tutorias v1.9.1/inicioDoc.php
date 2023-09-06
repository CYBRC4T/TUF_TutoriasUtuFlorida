<?php
    if(!isset($_COOKIE['ci']) || !isset($_COOKIE['rol']) || $_COOKIE['rol'] != "DOC")
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
                    <form action="verPerfil.php" method="post" id="perfForm">
                        <?php echo("<input type='number' name='perfCI' id='perfCI' value='" . $_COOKIE['ci'] . "'>"); ?>
                    </form>
                    <i class="fa-solid fa-user" onclick="document.getElementById('perfForm').submit()"></i>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="ventanas">
                <a id="boton" class="ventanas" onclick="toggleButton(this)" href="#"> MIS TUTORÍAS </a>
                <a id="boton2" class="ventanas2" onclick="toggleButton(this)" href="#"> CREAR TUTORÍA </a>
                <div class="filler"></div>
            </div>
            <div class="pageSwitch" id="docentes">
                <section class="tutorias" id="tuto">
                    <h1> Estas son tus tutorías: </h1>
                    <div class="grid" id="docente">
                        <?php
                            $conn = mysqli_connect("localhost", "root", "");
                            $dbb = mysqli_select_db($conn, "tutorias");

                            $query = mysqli_query($conn, "SELECT tutorias.id_tut AS id, materias.nombre AS Materia 
                            FROM tutorias, materias WHERE tutorias.materia = materias.id_mat AND tutorias.docente = " . $_COOKIE['ci']);
                            
                            $query2 = mysqli_query($conn, "SELECT count(id_tut) FROM tutorias, docentes WHERE tutorias.docente = " . $_COOKIE['ci']);
                            $cantidad = mysqli_fetch_array($query2)[0];

                            if($cantidad != 0)
                            {
                                while($row = mysqli_fetch_assoc($query))
                                {
                                    echo("<div class='item'> <a onclick='entrarMateria(" . $row["id"] . ")'>" . $row["Materia"] . "</a> </div>");
                                }
                            } else {
                                echo("<p> Aún no tienes tutorías... </p>");
                            }
                        ?>
                        <form class="hidden" action="detalleTut.php" method="post" id="matForm">
                            <?php 
                                echo("<input type='text' name='id_tut' id='id_tut' value=''>");
                            ?>
                        </form>
                    </div>
                </section>
                <section class="hidden" id="mate">
                    <form action="subirTutoria.php" method="post">
                        <input type="hidden" name="switch" id="switch" value="0">
                        
                        <div class="item"> 
                            <label for="materia"> Materia: </label>
                            <select id="materia" name="materia" onchange='this.blur()' onmouseleave="this.blur()">
                                <option value='def'> Elije una materia. </option>
                                <?php
                                    $query = mysqli_query($conn, "SELECT area FROM doc_areas WHERE ci_doc = " . $_COOKIE['ci']);
                                    $result = mysqli_fetch_array($query);

                                    $query2 = mysqli_query($conn, "SELECT * FROM materias WHERE area = " . $result[0]);

                                    if(mysqli_fetch_array($query2) != null) {
                                        while($row = mysqli_fetch_assoc($query2))
                                        {
                                            echo("<option value='" . $row['id_mat'] . "'>" . $row["nombre"] . "</option>");
                                            $area = $row['area'];
                                        }
                                    } else {
                                        echo("<option value='0'> No hay materias en tu área </option>");
                                        $area = '0';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="item">
                            <label for="mod"> Tipo de tutoría: </label>
                            <select name="mod" id="mod">
                                <option value="coord"> Coordinación </option>
                                <option value="exam"> Exámenes </option>
                            </select>
                        </div>
                        <div class="item">
                            <label for="dias"> Cantidad de días: </label>
                            <input type="number" name="dias" id="dias" max="15" min="1" value="1">
                        </div>
                        <div class="item">
                            <label for="desc"> Descripción: </label>
                            <textarea class="input" name="desc" id="desc"> </textarea>
                        </div>

                        <?php 
                            echo("<input type='hidden' name='area' id='area' value='" . $area . "'>");
                        ?>

                        <input type="submit" onclick="event.preventDefault(); 
                        if((document.getElementById('materia').value != 'def') && (document.getElementById('materia').value != '0'))
                            { this.submit() } else { alert('Por favor, elija una materia.') }
                        "value="CREAR TUTORÍA">
                    </form>
                </section>

                <aside>
                    <h4> Horarios </h4>
                    <hr>
                </aside>
            </div>
            <footer>
            </footer>
    </body>

    <script type="text/javascript">
        function entrarMateria(id)
        {
            document.getElementById('id_tut').value = id;

            document.getElementById('matForm').submit();
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
    </script>
</html>