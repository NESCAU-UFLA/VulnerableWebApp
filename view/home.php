<?php
include_once("../model/Usuario.php");
session_start();
if (isset($_SESSION['usuario'])) {
    $_SESSION['isChild'] = true;
?>
    <html>
        <head>
        <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
            <link href="../modules/style.css" rel="stylesheet" type="text/css" />
            <title>Home</title>
            <script>
                $(document).ready(function() {
                    $('.post-container')[0].scrollTop = $('.post-container')[0].scrollHeight;
                });
            </script>
        </head>
        <body>
            <?php include("main-home.php"); ?>
        </body>
    </html>
<?php
    unset($_SESSION['isChild']);
} else
    header("Location: index.php");
?>