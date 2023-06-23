<html lang='es'>
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="img/logo.png">
        <title> TUF | PÁGINA PRINCIPAL </title>
        <link rel="stylesheet" href="css/login.css">
        <script src="js/classManager.js"> </script>
    </head>
    <body>
        <nav>
            <img class="cybercat" src="img/cybercat.png">
            <hr>
            <img src="img/utu.png">
            <hr>
        </nav>

        <img class="loginLogo" src="img/logo.png">

        <div class="container">
            <div class="changeBtn">
                <a class="selected" onclick="toggleLogin(this)" id="btn1"> INICIAR SESIÓN </a>
                <a class="notSelected" onclick="toggleLogin(this)" id="btn2"> REGISTRARSE </a>
                <div class="fill"></div>
            </div>
            <div class="loginCard" id="loginCard">
                <h2> INICIO DE SESIÓN </h2>
                <form action="loginCheck.php" method="post">
                    <label> C.I. o Documento: </label>
                    <div class="formInput">
                        <img src="img/cedula.jpg">
                        <input type="text" name="cedula">
                    </div>
                    <label> Contraseña: </label>
                    <div class="formInput">
                        <img src="img/candado.png" id="img2">
                        <input type="password" name="contrasena">
                    </div>
                    <input type="submit" value="CONTINUAR">
                </form>
            </div>

            <div class="cardHidden" id="signupCard">
                <h2> REGISTRARSE </h2>
                <form action="loginCheck.php" method="post">
                    <label> C.I. o Documento: </label>
                    <div class="formInput">
                        <img src="img/cedula.jpg">
                        <input type="text" name="cedula">
                    </div>
                    <label> Nombres: </label>
                    <div class="formInput">
                        <img src="img/candado.png" id="img2">
                        <input type="password" name="nombre">
                    </div>
                    <label> Apellidos: </label>
                    <div class="formInput">
                        <img src="img/cedula.jpg">
                        <input type="text" name="apellido">
                    </div>
                    <label> Teléfono: </label>
                    <div class="formInput">
                        <img src="img/candado.png" id="img2">
                        <input type="password" name="telefono">
                    </div>
                    <label> Dirección: </label>
                    <div class="formInput">
                        <img src="img/cedula.jpg">
                        <input type="text" name="direccion">
                    </div>
                    <label> Correo Electrónico: </label>
                    <div class="formInput">
                        <img src="img/candado.png" id="img2">
                        <input type="password" name="email">
                    </div>
                    <br> 
                    <label> Contraseña: </label>
                    <div class="formInput">
                        <img src="img/cedula.jpg">
                        <input type="text" name="contrasena">
                    </div>
                    <label> Confirmar Contraseña: </label>
                    <div class="formInput">
                        <img src="img/candado.png" id="img2">
                        <input type="password" name="confContra">
                    </div>
                    <input type="submit" value="CONTINUAR">
                </form>
            </div>
        </div>
    </body>
    <script>
        function toggleLogin(btn)
        {
            let btn2 = document.getElementById("btn2");
            let loginCard = document.getElementById("loginCard");
            let signupCard = document.getElementById("signupCard");

            if(btn == btn2)
            {
                btn2 = document.getElementById("btn1");
                
                removeClass(signupCard, "cardHidden");
                addClass(signupCard, "signupCard");

                removeClass(loginCard, "loginCard");
                addClass(signupCard, "cardHidden");
            } else {
                removeClass(signupCard, "signupCard");
                addClass(signupCard, "hiddenCard");

                removeClass(loginCard, "cardHidden");
                addClass(loginCard, "loginCard");
            }

            if(hasClass(btn, "notSelected"))
            {
                removeClass(btn, "notSelected");
                addClass(btn, "selected");

                removeClass(btn2, "selected");
                addClass(btn2, "notSelected");
            }
        }
    </script>
</html>