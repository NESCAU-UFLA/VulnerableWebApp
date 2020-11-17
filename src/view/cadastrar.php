<?php session_start(); ?>
<html>
    <head>
        <script type="text/javascript" src="modules/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="modules/functions.js"></script>
        <link href="modules/style.css" rel="stylesheet" type="text/css" />
        <title>Login</title>
    </head>
    <body>
        <div class="containerCenter shadow-box" style="width: 400px; height: 300px; background-color: white;">
            <div style="padding-top: 2%; max-width: 200px;">
                <form method="POST" action="controller/usuario.php" enctype="multipart/form-data">
                    <input type="hidden" name="Usuario" value="Cadastrar" />
                    <input type="text" name="Login" placeholder="Usuario" required /><br/>
                    <input type="text" name="Nome" placeholder="Nome" required /><br/>
                    <input type="password" autocomplete="new-password" name="Senha" placeholder="Senha" required /><br/>
                    <input type="password" autocomplete="new-password" name="Confirmar" placeholder="Confirmar senha" required /><br/>
                    <input type="file" name="foto" /><br/><br/>
                    <div>
                        <button type="submit" name="cadastrar" onclick="return validarSenha();">Cadastrar</button>
                        <a href="index.php">
                            <button type="button" style="float: right;">Voltar</button>
                        </a>
                    </div>
                </form>
                <?php
                if (isset($_SESSION['resultado'])) {
                    echo '<p style="color:red">'.$_SESSION['resultado'].'</p>';
                    unset($_SESSION['resultado']);
                }
                ?>
            </div>
        </div>
    </body>
</html>