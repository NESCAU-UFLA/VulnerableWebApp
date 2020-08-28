<?php
    include_once("../model/Usuario.php");
    session_start();
    if (isset($_SESSION['usuario'])) {
        $user = unserialize($_SESSION['usuario']);
?>
        <html>
            <head>
                <link href="../modules/style.css" rel="stylesheet" type="text/css" />
                <title>Login</title>
            </head>
            <body>
                <div class="containerCenter" style="width: 800px; height: 250px; background-color: white;">
                    <div class="inner-column" style="border-right: 1px solid grey;">
                        <div class="user-img">
<?php                       echo '<img src="../uploads/'.$user->getFoto().'" />'; ?>
                        </div><br/>
                        <form method="POST" action="../controller/usuario.php">
                            <input type="hidden" name="Usuario" value="EditarFoto" />
                            <input type="file" name="foto" required /><br/><br/>
                            <button type="submit">Alterar foto</button>
                        </form>
                    </div>
                    <div class="inner-column" style="border-right: 1px solid grey; padding-top: 30px;">
                        <form method="POST" action="../controller/usuario.php">
                            <input type="hidden" name="Usuario" value="EditarDados" />
                            <input type="text" placeholder="Usuário: <?php echo $user->getLogin(); ?>" /><br/>
                            <input type="text" placeholder="Nome: <?php echo $user->getNome(); ?>" /><br/>
                            <button type="submit">Alterar dados</button>
                        </form>
                    </div>
                    <div class="inner-column" style="padding-top: 30px;">
                        <form method="POST" action="../controller/usuario.php">
                        <input type="hidden" name="Usuario" value="EditarSenha" />
                            <input type="password" autocomplete="new-password" placeholder="Senha" /><br/>
                            <input type="password" autocomplete="new-password" placeholder="Confirmar senha" /><br/>
                            <button type="submit">Alterar senha</button>
                        </form>
                    </div>
                    <div>
                        <a href="home.php">
                            <button>Voltar</button>
                        </a>
                    </div>
                </div>
            </body>
        </html>
<?php
    } else
        header("Location: index.php");
?>