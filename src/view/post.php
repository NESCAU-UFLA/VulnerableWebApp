<?php
require("../modules/functions.php");

session_start();

if (isset($_SESSION['usuario']) && (isset($_GET['id']) || isset($_GET['msg']))) {
?>
    <html>
        <head>
            <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="../modules/functions.js"></script>
            <link href="../modules/style.css" rel="stylesheet" type="text/css" />
            <title>Post</title>
        </head>
        <body>
            <?php
            if (isset($_GET['id']))
                mostrarPostagemPorId($_GET['id']);
            else if (isset($_GET['msg']))
                mostrarPostagensPorMensagem($_GET['msg']);
            else
                header("Location: home.php");
            ?>
        </body>
    </html>
<?php
    if (isset($_SESSION['resultado'])) {
        echo '<script>alert("'.$_SESSION['resultado'].'")</script>';
        unset($_SESSION['resultado']);
    }
} else
    header("Location: ../index.php");
?>