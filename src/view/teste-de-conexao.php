<?php
require("../modules/functions.php");

session_start();

if (isset($_SESSION['usuario'])) {
?>
    <html>
        <head>
            <link href="../modules/style.css" rel="stylesheet" type="text/css" />
            <title>Teste de conexão</title>
        </head>
        <body>
            <div class="shadow-box" style="background-color: white; text-align: center; height: 350px; width: 450px;">
                <div style="height: 200px;">
                    <a href="home.php">
                        <button style="float: left;">Voltar ao Início</button>
                    </a><br/>
                    <div style="height: 100%; overflow-x: auto; overflow-y: auto; background-color: black; color: white; margin: 20px; padding-left: 20px; padding-right: 20px;">
                        <?php
                        if (isset($_GET['ip']))
                            echo '<pre>'.shell_exec("ping -c 4 ".$_GET['ip']).'</pre>';
                        ?>
                    </div>
                </div>
                <br/>
                <div style="margin-top: 40px;">
                    <form method="GET" action="">
                        <input type="text" name="ip" placeholder="Insira seu IP" /><br/>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </body>
    </html>
<?php
} else
    header("Location: ../index.php");
?>