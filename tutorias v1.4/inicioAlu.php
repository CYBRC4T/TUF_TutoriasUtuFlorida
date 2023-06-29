<html lang='es'>

    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="img/logo.png">
        <title> TUF | INICIO </title>
        <link rel="stylesheet" href="css/inicioAlu.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
        <script src="js/classManager.js"> </script>
    </head>

    <body>
        <nav>
            <img class="cybercat" src="img/cybercat.png">
            <div class="divisor"></div>
            <img src="img/utu.png">
            <div class="divisor"></div>
            <p> Tutorias UTU Florida </p>
        </nav>
        <div class="sugHidden" id="menuSugerencia">
            <h1> ¡Envía tu solicitud! </h1>
            <hr>
            <div class="sugMenu">  
                <form>
                    <textarea id="texto" name="texto"></textarea>
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
                            while($x != 25)
                            {
                                echo("<div class='item'> <p> MATERIA </p> </div>");
                                $x++;
                            }
                        ?>
                    </div>
                    <h3> ¿No ves la tutoría que quieres? Has click <a href="#" onclick="mostrarSugerencia()">aquí</a> para solicitarla. </h3>
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

            if(!x) {
                removeClass(btn, "ventanas");
                addClass(btn, "ventanas2");

                removeClass(btn2, "ventanas2");
                addClass(btn2, "ventanas");

                console.log(btn.className);
                console.log(btn2.className);
            } else {
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