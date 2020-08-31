<?php
    include_once("../model/Usuario.php");
    session_start();
    if (isset($_SESSION['usuario'])) {
        $user = unserialize($_SESSION['usuario']);
?>
        <html>
            <head>
                <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
                <script type="text/javascript" src="../modules/functions.js"></script>
                <link href="../modules/style.css" rel="stylesheet" type="text/css" />
                <title>Login</title>
            </head>
            <body>
                <div class="containerCenter shadow-box" style="width: 820px; height: 250px; background-color: white;">
                    <div class="inner-column" style="border-right: 1px solid grey;">
                        <div class="user-img">
                            <?php echo '<img src="../uploads/'.$user->getFoto().'" />'; ?>
                        </div><br/>
                        <form id="formImagem" method="POST" action="../controller/usuario.php" style="display: none;">
                            <input type="hidden" name="Usuario" value="EditarFoto" />
                            <input type="file" name="foto" style="width:200px;" required /><br/><br/>
                            <button type="submit">Alterar foto</button>
                        </form>
                    </div>
                    <div class="inner-column" style="border-right: 1px solid grey; padding-top: 30px;">
                        <div id="dados">
                            <h4>Usuário: <?php echo $user->getLogin(); ?></h4>
                            <h4>Nome: <?php echo $user->getNome(); ?></h4><br/><br/><br/>
                            <button onclick="mostrarFormDados();">Editar dados</button>
                        </div>
                        <div id="formDados" style="display: none;">
                            <form method="POST" action="../controller/usuario.php">
                                <input type="hidden" name="Usuario" value="EditarDados" />
                                <input type="text" name="Login" placeholder="Usuário: <?php echo $user->getLogin(); ?>" /><br/>
                                <input type="text" name="Nome" placeholder="Nome: <?php echo $user->getNome(); ?>" /><br/>
                                <button type="submit">Alterar dados</button>
                            </form><br/>
                            <button onclick="esconderFormDados();">Cancelar</button>
                        </div>
                    </div>
                    <div class="inner-column" style="padding-top: 30px;">
                        <div id="formSenha" style="display: none;">
                            <form method="POST" action="../controller/usuario.php">
                                <input type="hidden" name="Usuario" value="EditarSenha" />
                                <input type="password" autocomplete="new-password" name="Senha" placeholder="Senha" /><br/>
                                <input type="password" autocomplete="new-password" name="Confirmar" placeholder="Confirmar senha" /><br/>
                                <button type="submit" onclick="return validarSenha();">Alterar senha</button>
                            </form>
                            <br/>
                            <form method="POST" action="../controller/usuario.php">
                                <input type="hidden" name="Usuario" value="ExcluirConta" />
                                <button type="submit">Excluir conta</button>
                            </form>
                        </div>
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