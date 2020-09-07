<?php
require("../modules/functions.php");

session_start();

if (isset($_SESSION['usuario']) && (isset($_GET['id']) || isset($_GET['msg']))) {

?>
    <html>
        <head>
            <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
            <link href="../modules/style.css" rel="stylesheet" type="text/css" />
            <title>Post</title>
        </head>
        <body>
            <?php
            if (isset($_GET['id']))
                mostrarPostagemPorId($_GET['id']);
            else if (isset($_GET['msg']))
                mostrarPostagensPorMensagem($_GET['msg']);
            ?>
        </body>
    </html>
<?php
} else
    header("Location: ../index.php");
?>