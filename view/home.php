<?php
require_once("../model/Usuario.php");
require_once("../persistence/PostagemDAO.php");

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
                </div>
                <div class="column shadow-box" style="width: 300px;">
                    <div class="post-container" style="height: 250px;">
                        <?php
                        $postagens = (new PostagemDAO())->recuperarTodos();
                        $ehPar = true;
                        $color = "";
                        foreach ($postagens as $post) {
                            if ($ehPar)
                                $color = "#e8e8e8";
                            else
                                $color = "white";
                            $ehPar = !$ehPar;
                        ?>
                            <a href="post.php?id=<?php echo $post[0]; ?>" style="text-decoration: none; color: black;">
                                <div class="post-content" style="background-color: <?php echo $color; ?>;">
                                    <?php echo '['.$post[3].'] '.$post[7].' escreveu:<br/>'.$post[2]; ?>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
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
<?php
} else
    header("Location: index.php");
?>