<html lang='es'>
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="img/logo.png">
        <title> TITULO </title>
        <link rel="stylesheet" href="css/inicioAlu.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav>
            <img src="img/utu.png">
            <div class="divisor"></div>
            <p> Tutorias UTU Florida </p>
            <a href="inicioEst.php"> Inicio EST </a>
            <a> - </a>
            <a href="inicioDoc.php"> Inicio DOC </a>
            <a> - </a>
            <a href="inicioAdm.php"> Inicio ADM </a>
            <i class="fa-solid fa-user" onclick="window.location.href = 'cerrarSesion.php'"></i>
        </nav>

        <div class="container">
            <div class="ventanas">
                <a id="boton" class="ventanas" onclick="toggleButton(this)" href="#"> ADMINISTRAR TUTORÍAS </a>
                <a id="boton2" class="ventanas2" onclick="toggleButton(this)" href="#"> ADMINISTRAR USUARIOS </a>
                <div class="filler"></div>
            </div>
            <div class="pageSwitch">
                <section class="tutorias">
                    <h1> Estas son tus tutorías: </h1>
                    <div class="grid">
                        <?php
                            $x = 0;
                            while($x != 5)
                            {
                                echo("<div class='item'> <p> MATERIA </p> </div>");
                                $x++;
                            }
                        ?>
                    </div>
                </section>
                <section class="materias">
                    
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