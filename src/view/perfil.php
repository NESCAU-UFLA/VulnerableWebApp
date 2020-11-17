<?php
require("../modules/functions.php");

session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $admin = false;
    verificarVisitanteDoPerfil();
?>
    <html>
        <head>
            <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="../modules/functions.js"></script>
            <link href="../modules/style.css" rel="stylesheet" type="text/css" />
            <title>Perfil</title>
        </head>
        <body>
            <div class="containerCenter shadow-box" style="height: 350px; background-color: white;">
                <div style="width: 250px!important;">
                    <a href="home.php">
                        <button style="float: left;">Voltar ao Início</button>
                    </a>
                    <div class="inner-column" style="width: 150px; margin-left: 35px;">
                        <div class="user-img" style="margin-top:40px;">
                            <?php echo '<img src="../uploads/'.$usuario->getFoto().'" />'; ?>
                        </div><br/>
                        <div id="dados">
                            <?php mostrarDadosDoPerfil(); ?>
                        </div>
                        <div id="formImagem" style="display: none;">
                            <form method="POST" action="../controller/usuario.php" enctype="multipart/form-data">
                                <input type="hidden" name="Usuario" value="EditarFoto" />
                                <label>Escolha uma imagem...</label>
                                <input type="file" name="foto" style="width:200px;" required /><br/><br/>
                                <button type="submit" value="Alterar">Alterar foto</button>
                            </form>
                            <form method="POST" action="../controller/usuario.php">
                                <input type="hidden" name="Usuario" value="EditarFoto" />
                                <button type="submit">Excluir foto</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="inner-column" style="width: 250px; border-left: 1px solid grey; padding-top: 30px;">
                    <div id="postagensDoUsuario">
                        <?php mostrarPostagensDoUsuario(); ?>
                    </div>
                    <div id="formDados" style="display: none;">
                        <form method="POST" action="../controller/usuario.php">
                            <input type="hidden" name="Usuario" value="EditarDados" />
                            <input type="text" name="Login" placeholder="Usuário: <?php echo $usuario->getLogin(); ?>" /><br/>
                            <input type="text" name="Nome" placeholder="Nome: <?php echo $usuario->getNome(); ?>" /><br/><br/>
                            <button type="submit">Alterar dados</button>
                        </form>
                        <br/><br/><br/><br/><br/>
                        <button onclick="esconderFormDados();">Cancelar</button>
                    </div>
                </div>
                <?php colunaDeEdicaoPerfil(); ?>
            </div>
        </body>
    </html>
<?php
} else
    header("Location: ../index.php");
?>