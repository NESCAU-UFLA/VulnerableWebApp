<?php
    session_start();
    $user = unserialize($_SESSION['usuario']);
?>
<html>
    <head>
        <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="../modules/functions.js"></script>
        <link href="../modules/style.css" rel="stylesheet" type="text/css" />
        <title>Home</title>
    </head>
    <body>
        <div style="display: flex;">
            <div class="column" style="width: 200px; height: 300px; background-color: white;">
                a
            </div>
            <div class="column" style="width: 300px; height: 300px; background-color: white;">
                a
            </div>
            <div class="column" style="width: 200px; height: 300px; background-color: white;">
                <div class="user-img" style="margin-top: 10px;">
        <?php       echo '<img src="../uploads/'.$user->getFoto().'" />'; ?>
                </div>
                <h3>
        <?php       echo "Bem-vindo, ".$user->getNome()."!";?>
                </h3><br/>
                <div>
                    <a href="editar-dados.php">
                        <button>Ver perfil</button>
                    </a><br/><br/>
                    <form method="POST" action="../controller/usuario.php">
                        <input type="hidden" name="Usuario" value="Logout" />
                        <button type="submit">Desconectar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>