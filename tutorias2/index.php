<html>

    <head>
        <title> TUTORIAS | PÁGINA PRINCIPAL </title>
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
            <p> TUTORIAS </p>
        </nav>
        <div class="container">
            <div class="ventanas">
                <a id="boton" class="ventanas" onclick="buttons()" href="#"> TUTORIAS </a>
                <a id="boton" class="ventanas2" onclick="buttons()" href="#"> MATERIAS </a>
                <div class="filler"></div>
            </div>
            <div class="materias">
                <section>
                    <h3> ¿No ves la tutoría que quieres? Has click <a href="#">aquí</a> para solicitarla. </h3>
                </section>

                <aside>
                    <h4> Horarios </h4>
                    <hr>
                </aside>
            </div>
            <footer>
            </footer>
    </body>
    <script>
        document.getElementById("boton").addEventListener("click", myScript);

        document.getElementById('boton').onclick = function(){
            
            element.class = (element.class == "opacityClicked") ? "opacityDefault" : "opacityClicked";
        }
    </script>
</html>