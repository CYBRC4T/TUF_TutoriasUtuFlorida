<?php
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
?>