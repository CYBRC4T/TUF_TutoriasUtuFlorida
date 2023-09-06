<html lang='es'>
    <head>

        <meta charset="UTF-8" />
        <link rel="icon" href="img/logoIcon.svg">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    </head>
    <body>
        
        <?php 
            echo(implode($_POST['areas']));
            if(isset($_POST['areas']))
            {
                foreach($_POST['areas'] as $estado) 
                {
                    echo("<p>" . $estado . "</p>");
                }
            }
        ?>
    </body>

    <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            width: '300px'
        });
        });
    </script>
</html>