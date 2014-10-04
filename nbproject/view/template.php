<?php
session_start();
if (!empty($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="shortcut icon" href="../static/img/favicon.png">

            <title>Phanter</title>

            <!-- Bootstrap core CSS -->
            <link href="../static/bootstrap/css/bootstrap.css" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="../static/css/starter-template.css" rel="stylesheet">
        </head>

        <body>

            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Phanter</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <?php include_once 'menu.php'; ?>
                    </div><!--/.nav-collapse -->
                </div>
            </div>

            <div class="container">

                <div class="starter-template">
                    <div class="well col-lg-8 col-lg-offset-2">
                        <?php content(); ?>
                    </div>
                </div>

            </div><!-- /.container -->

            <script src="../static/js/jquery.min.js"></script>
            <script src="../static/js/jquery.mask.min.js"></script>
            <script src="../static/bootstrap/js/bootstrap.min.js"></script>
        </body>
    </html>
    <?php
} else {
    echo '<script>
           alert("Login incorreto!");
           location.href="../index.html";
           </script>';
}
?>