<?php
if (isset($_GET['page']))
    include($_GET['page']);
else {
    session_start();
?>
    <html>
        <head>
            <link href="modules/style.css" rel="stylesheet" type="text/css" />
            <title>Login</title>
        </head>
        <body>
            <div class="containerCenter shadow-box" style="width: 400px; height: 300px; background-color: white;">
                <div style="padding-top: 20%; max-width: 200px;">
                    <form method="POST" action="controller/usuario.php">
                        <input type="hidden" name="Usuario" value="Login" />
                        <input type="text" name="Login" placeholder="Usuario" /><br/><br/>
                        <input type="password" autocomplete="new-password" name="Senha" placeholder="Senha" /><br/><br/>
                        <div>
                            <button type="submit" name="login">Entrar</button>
                            <a href="?page=view/cadastrar.php">
                                <button type="button" style="float: right;">Cadastrar</button>
                            </a>
                        </div>
                    </form>
                    <?php
                    if (isset($_SESSION['resultado'])) {
                        if ($_SESSION['resultado'][0])
                            echo '<p style="color:green">'.$_SESSION['resultado'][1].'</p>';
                        else
                            echo '<p style="color:red">'.$_SESSION['resultado'][1].'</p>';
                        unset($_SESSION['resultado']);
                    }
                    ?>
                </div>
            </div>
        </body>
    </html>
<?php
    }
?>