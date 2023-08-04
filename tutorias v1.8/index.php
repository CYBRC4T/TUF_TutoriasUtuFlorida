<?php
    if(isset($_COOKIE['ci']))
    {
        $sql = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($sql, "tutorias");
        $query = mysqli_query($sql, "SELECT contrasena FROM estudiantes WHERE ci_est =" . $_COOKIE['ci']);
        $result = mysqli_fetch_array($query);
        
        echo "<form action='accessCheck.php' method='post' id='myForm'>";
        echo "<input type='hidden' name='login' id='login' value='1'>";
        echo "<input type='hidden' name='logged' id='logged' value='1'>";
        echo "<input type='text' name='cedula' value=" . $_COOKIE['ci'] . ">";
        echo "<script>"
                . "var varTimerInMiliseconds = 1;
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
        <title> TUF | PÁGINA PRINCIPAL </title>
        <link rel="stylesheet" href="css/login.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="logoBG">
            <img class="loginLogo" src="img/logo.png">
        </div>

        <div class="container">
            <div class="changeBtn">
                <a class="selected" onclick="toggleLogin(this)" id="btn1"> INICIAR SESIÓN </a>
                <a class="notSelected" onclick="toggleLogin(this)" id="btn2"> REGISTRARSE </a>
                <div class="fill"></div>
            </div>
            <div class="loginCard" id="loginCard">
                <h2 onload="changeText(this)"> INICIO DE SESIÓN </h2> <hr>
                <form action="accessCheck.php" method="post">
                    <input type="hidden" name="login" id="login" value="1">
                    <input type="hidden" name="logged" id="logged" value="0">
                    <label> C.I. o Documento: </label>
                    <div class="formInput">
                        <i class="fa-solid fa-id-card" style="color: #87acee;"></i>
                        <input type="text" name="cedula">
                    </div>
                    <label> Contraseña: </label>
                    <div class="formInput">
                        <i id="lock" class="fa-solid fa-lock" style="color: #87acee;"></i>
                        <input type="password" name="contrasena">
                    </div>
                    <input type="submit" value="CONTINUAR">
                </form>
            </div>

            <div class="cardHidden" id="signupCard">
                <h2> REGISTRARSE </h2> <hr>
                <form action="accessCheck.php" method="post" onsubmit="event.preventDefault(); stopForm(this);">
                    <input type="hidden" name="login" id="login" value="0">
                    <label> C.I. o Documento: </label>
                    <div class="formInput">
                        <i class="fa-solid fa-id-card" style="color: #87acee;"></i>
                        <input type="number" name="cedula" id="cedula" oninput="keepNumbers()">
                    </div>
                    <label> Nombres: </label>
                    <div class="formInput">
                        <i class="fa-solid fa-font" style="color: #87acee;"></i>
                        <input type="text" name="nombre" id="nombre">
                    </div>
                    <label> Apellidos: </label>
                    <div class="formInput">
                        <i class="fa-solid fa-bold" style="color: #87acee;"></i>
                        <input type="text" name="apellido" id="apellido">
                    </div>
                    <label> Teléfono: </label>
                    <div class="formInput">
                        <i class="fa-solid fa-phone" style="color: #87acee;"></i>
                        <input type="number" name="telefono" id="telefono">
                    </div>
                    <label> Dirección: </label>
                    <div class="formInput">
                        <i class="fa-solid fa-house-user" style="color: #87acee;"></i>
                        <input type="text" name="direccion" id="direccion">
                    </div>
                    <label> Correo Electrónico: </label>
                    <div class="formInput">
                        <i class="fa-solid fa-envelope" style="color: #87acee;"></i>
                        <input type="email" name="email" id="email">
                    </div>
                    <br> 
                    <label> Contraseña: </label>
                    <div class="formInput">
                        <i id="lock" class="fa-solid fa-lock" style="color: #87acee;"></i>
                        <input type="password" name="contrasena" id="contrasena" oninput="checkPass()">
                    </div>
                    <p id="passMatch" class="hide"> La contraseña no coincide. </p>
                    <label> Confirmar Contraseña: </label>
                    <div class="formInput">
                        <i id="lock" class="fa-solid fa-lock" style="color: #87acee;"></i>
                        <input type="password" name="confContra" id="confContra" oninput="checkPass()">
                    </div>
                    <input type="submit" value="CONTINUAR">
                    <br> <br>
                </form>
            </div>
        </div>
    </body>
    <script>
        function keepNumbers(){
            let input = document.getElementById('cedula');
            let text = input.value;
        }

        function stopForm(form){
            let contra = document.getElementById('contrasena').value;
            let confir = document.getElementById('confContra').value;

            if((confir == contra) && (confir != '')){
                form.submit();
            }
        }

        function toggleLogin(btn)
        {
            let btn2 = document.getElementById("btn2");
            const loginCard = document.getElementById("loginCard");
            const signupCard = document.getElementById("signupCard");

            if(btn == document.getElementById("btn2"))
            {
                btn2 = document.getElementById("btn1");
                
                removeClass(signupCard, "cardHidden");
                addClass(signupCard, "signupCard");

                removeClass(loginCard, "loginCard");
                addClass(loginCard, "cardHidden");
            } else {
                removeClass(signupCard, "signupCard");
                addClass(signupCard, "cardHidden");

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

        function checkPass(){
            let contra = document.getElementById('contrasena').value;
            let confir = document.getElementById('confContra').value;
            let checkTXT = document.getElementById('passMatch');

            if(confir == contra){
                removeClass(checkTXT, "show");
                addClass(checkTXT, "hide");
            } else {
                removeClass(checkTXT, "hide");
                addClass(checkTXT, "show");
            }
        }
    </script>
</html>