<?php
    if(!isset($_COOKIE['ci']) || !isset($_COOKIE['rol']))
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
        <title> TITULO </title>
        <link rel="stylesheet" href="css/login.css">

        <script src="js/classManager.js"> </script>
        <script src="https://kit.fontawesome.com/0ff8d7e0ed.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
                switch($_POST['arcType']) 
                {
                    case 'pfp':
                        $directorio = "archivos/pfp/";

                        $filename = explode(".", $_FILES["archivo"]["name"]);
                        $filename[0] = $_COOKIE['ci'];
                        $filename = implode(".", array($filename[0], $filename[count($filename) - 1]));
                        $_FILES["archivo"]["name"] = $filename;
                        break;

                    case 'perfBanner':
                        $directorio = "archivos/perfBanner/";

                        $filename = explode(".", $_FILES["archivo"]["name"]);
                        $filename[0] = $_COOKIE['ci'];
                        $filename = implode(".", array($filename[0], $filename[count($filename) - 1]));
                        $_FILES["archivo"]["name"] = $filename;
                        break;

                    case 'tutBanner':
                        $directorio = "archivos/tutBanner/";

                        $filename = explode(".", $_FILES["archivo"]["name"]);
                        $filename[0] = $_POST['tutCI'];
                        $filename = implode(".", array($filename[0], $filename[count($filename) - 1]));
                        $_FILES["archivo"]["name"] = $filename;
                        break;
                    
                    case 'tutFile':
                        $directorio = "archivos/tutFiles/";

                        $filename = explode(".", $_FILES["archivo"]["name"]);
                        $filename[0] = $_POST['tutCI'];
                        $filename = implode(".", array($filename[0], $filename[count($filename) - 1]));
                        $_FILES["archivo"]["name"] = $filename;
                        break;
                }

                $canUpload = 1;
                $finalizado = 0;

                // Si el archivo pesa más que 50MB, no permitir que se suba.
                if ($_FILES["archivo"]["size"] > 50000000) 
                {
                    $canUpload = 0;
                }

                // Si el archivo es una imágen, proceder con el código correspondientes
                if(($_POST['arcType'] == "pfp") && ($_POST['arcType'] == "perfBanner") && ($_POST['arcType'] == "tutBanner")) 
                {
                    $archivo = $directorio . basename($_FILES["archivo"]["name"]);

                    $imageFileType = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));

                    $check = getimagesize($_FILES["archivo"]["tmp_name"]);
                        
                    if($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $canUpload = 1;
                    } else {
                        echo "File is not an image.";
                        $canUpload = 0;
                    }
                    
                    switch($imageFileType)
                    {
                        case "jpg":
                            $existe = (file_exists($directorio . $_COOKIE['ci'] . ".jpeg") || file_exists($directorio . $_COOKIE['ci'] . ".png"));
                            break;
                        case "jpeg":
                            $existe = (file_exists($directorio . $_COOKIE['ci'] . ".jpg") || file_exists($directorio . $_COOKIE['ci'] . ".png"));
                            break;
                        case "png":
                            $existe = (file_exists($directorio . $_COOKIE['ci'] . ".jpeg") || file_exists($directorio . $_COOKIE['ci'] . ".jpg"));
                            break;
                    }

                    if ($existe && ($canUpload == 1)) 
                    {
                        unlink($directorio . $_COOKIE['ci'] . ".jpeg");
                        unlink($directorio . $_COOKIE['ci'] . ".jpg");
                        unlink($directorio . $_COOKIE['ci'] . ".png");
                    }

                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
                    {
                        $canUpload = 0;
                    }

                    if ($canUpload == 1) 
                    {
                        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo)) 
                        {
                            $finalizado = 1;
                        }
                    }
                    
                    list($current_width, $current_height) = getimagesize($archivo);

                    $left = $current_width / 2 - ($current_width / 2);
                    $top = $current_height / 2 - ($current_width / 2);

                    $crop_width = $current_width;
                    $crop_height = $current_width;

                    $canvas = imagecreatetruecolor($crop_width, $crop_height);

                    switch($imageFileType)
                    {
                        case "jpg":
                            $current_image = imagecreatefromjpeg($archivo);
                            break;
                        case "jpeg":
                            $current_image = imagecreatefromjpeg($archivo);
                            break;
                        case "png":
                                $current_image = imagecreatefrompng($archivo);
                            break;
                    }

                    imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
                    imagejpeg($canvas, $archivo, 100);
                } else {
                    // En cambio, al no ser una imágen, continuar con la subida de un archivo.
                    $archivo = $directorio . basename($_FILES["archivo"]["name"]);

                    $fileType = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
                    
                    $existe = file_exists($directorio . $_COOKIE['tut_id'] . "" . $fileType);
                }
                
                if($finalizado == 1)
                {
                    switch($_POST['arcType'])
                    {
                        case "perfBanner", "pfp":
                            echo ("<form action='verPerfil.php' method='post' id='myForm'>");
                            echo ("<input type='number' name='perfCI' id='perfCI' value='" . $_COOKIE['ci'] . "'>");
                            break;
                        case "tutBanner", "tutFile":
                            echo ("<form action='detalleTutoria.php' method='post' id='myForm'>");
                            echo ("<input type='number' name='tut_id' id='tut_id' value='" . $_COOKIE['tut_id'] . "'>");
                            unset($_COOKIE['tut_id']);
                            break;
                    }

                        echo ("<script>"
                            . "var varTimerInMiliseconds = 100;
                                setTimeout(function(){ 
                                    document.getElementById('myForm').submit();
                                }, varTimerInMiliseconds);"
                            . "</script>");
                    echo ("</form>");
                }
        ?>
    </body>
</html>