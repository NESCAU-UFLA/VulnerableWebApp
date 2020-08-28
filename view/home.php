<?php session_start(); ?>
<html>
    <head>
        <link href="../modules/style.css" rel="stylesheet" type="text/css" />
        <title>Home</title>
    </head>
    <body>
        <div style="display: flex;">
            <div class="containerCenter column" style="width: 300px; height: 300px; background-color: white;">
                a
            </div>
            <div class="containerCenter column" style="width: 300px; height: 300px; background-color: white;">
                a
            </div>
            <div class="containerCenter column" style="width: 300px; height: 300px; background-color: white;">
                <div class="user-img">
<?php               echo '<img src="../uploads/'.unserialize($_SESSION['usuario'])->getFoto().'" />'; ?>
                </div>
            </div>
        </div>
    </body>
</html>