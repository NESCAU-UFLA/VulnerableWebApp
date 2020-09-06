<?php
require("../modules/functions.php");

session_start();

if (isset($_SESSION['usuario']) && (isset($_GET['id']) || isset($GET['msg']))) {
?>
    <html>
        <head>
            <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
            <link href="../modules/style.css" rel="stylesheet" type="text/css" />
            <title>Post</title>
        </head>
        <body>
            <div class="containerCenter shadow-box" style="background-color: white; width: 600px; height: 300px;">
                <?php mostrarPostagemPorId($_GET['id']); ?>
            </div>
        </body>
    </html>
<?php
} else
    header("Location: ../index.php");
?>