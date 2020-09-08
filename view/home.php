<?php
require("../modules/functions.php");

session_start();

if (isset($_SESSION['usuario'])) {
    $user = unserialize($_SESSION['usuario']);
?>
    <html>
        <head>
        <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
            <link href="../modules/style.css" rel="stylesheet" type="text/css" />
            <title>Home</title>
            <script>
                $(document).ready(function() {
                    $('.post-container')[0].scrollTop = $('.post-container')[0].scrollHeight;
                });
            </script>
        </head>
        <body>
            <div style="display: flex;">
                <div class="column shadow-box" style="width: 200px;">
                    <form method="GET" action="post.php">
                        <input type="text" name="msg" placeholder="Pesquisar mensagem" required />
                        <button type="submit">Pesquisar</button>
                    </form>
                    <br/><br/><br/>
                    Lentidão ao navegar pelo fórum? Teste a sua conexão <a href="teste-de-conexao.php">aqui</a>
                </div>
                <div class="column shadow-box" style="width: 300px;">
                    <?php mostrarTodasPostagens(); ?>
                    <div style="margin-top: 30px;">
                        <form method="POST" action="../controller/postagem.php">
                            <input type="hidden" name="Postagem" value="Inserir" />
                            <textarea name="Mensagem" placeholder="Escreva aqui ..." style="height: 70px;" required ></textarea><br/><br/>
                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
                <div class="column shadow-box" style="width: 200px;">
                    <div class="user-img" style="margin-top: 10px;">
                        <?php echo '<img src="../uploads/'.$user->getFoto().'" />'; ?>
                    </div>
                    <h3>
                        <?php echo "Bem-vindo, ".$user->getNome()."!";?>
                    </h3><br/>
                    <div>
                        <a href="perfil.php">
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
<?php
} else
    header("Location: ../index.php");
?>