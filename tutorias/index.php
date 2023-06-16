<html>

    <head>
        <link rel="icon" href="img/logo.png">
        <title> TUF | PÁGINA PRINCIPAL </title>
        <link rel="stylesheet" href="css/estilo1.css">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />

    </head>

    <body>
        <nav>
            <img class="cybercat" src="img/cybercat.png">
            <div class="divisor"></div>
            <img src="img/utu.png">
            <div class="divisor"></div>
            <p> Tutorias UTU Florida </p>
        </nav>
        <div class="container">
            <div class="ventanas">
                <a id="boton" class="ventanas" onclick="toggleButton(this)" href="#"> TUTORIAS </a>
                <a id="boton2" class="ventanas2" onclick="toggleButton(this)" href="#"> MATERIAS </a>
                <div class="filler"></div>
            </div>
            <div class="pageSwitch">
                <section class="tutorias">
                    <h3> ¿No ves la tutoría que quieres? Has click <a href="#">aquí</a> para solicitarla. </h3>
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
        function hasClass(element, className) {
            return element.classList.contains(className);
        }

        function addClass(element, className) {
            element.classList.add(className);
        }

        function removeClass(element, className) {
            element.classList.remove(className);
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

            console.log(x);
        }
    </script>
</html>