<?php
    include_once("../model/Usuario.php");
    session_start();
    $_SESSION['isChild'] = true;
    if (isset($_SESSION['usuario'])) {
?>
        <html>
            <head>
                <link href="../modules/style.css" rel="stylesheet" type="text/css" />
                <title>Home</title>
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