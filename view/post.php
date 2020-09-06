<?php
require_once("../model/Usuario.php");
require_once("../persistence/UsuarioDAO.php");
require_once("../persistence/PostagemDAO.php");

session_start();

if (isset($_SESSION['usuario']) && (isset($_GET['id']) || isset($GET['msg']))) {
    
?>
    <html>
        <head>
            <script type="text/javascript" src="../modules/jquery-3.5.1.min.js"></script>
            <link href="../modules/style.css" rel="stylesheet" type="text/css" />
            <title>Post</title>
        </head>
        <body>
            <div class="containerCenter shadow-box" style="background-color: white; width: 600px; height: 300px;">
                <?php
                try {
                    $autor = (new UsuarioDAO())->recuperarPorIdPost($_GET['id']);
                    $autor->setPostagemAtual((new PostagemDAO())->recuperarPorId($_GET['id']));
                ?>
                    <div style="width: 200px;">
                        <a href="home.php">
                            <button style="float: left;">Voltar</button>
                        </a>
                        <div style="text-align: center; padding-left: 35px;">
                            <div class="user-img" style="margin-top: 50px;">
                                <?php echo '<img src="../uploads/'.$autor->getFoto().'" />'; ?>
                            </div><br/>
                            <h4>
                                <?php echo $autor->getNome(); ?>
                            </h4>
                        </div>
                    </div>
                    <div style="width: 400px; padding: 20px; padding-top: 30px;">
                        <div class="post-content" style="text-align: justify;">
                            <?php echo '" '.$autor->getPostagemAtual()->getMensagem().' "'; ?>
                        </div><br/>
                        <div>
                            Postado em: <?php echo $autor->getPostagemAtual()->getDataPostagem(); ?>
                            <br/>
                            <?php
                                $dataUltimaEdicao = $autor->getPostagemAtual()->getDataUltimaEdicao();
                                if ($dataUltimaEdicao != "")
                                    echo 'Ultima edição em: '.$dataUltimaEdicao;
                            ?>
                        </div>
                    </div>
                <?php
                } catch(Exception $e) {
                    echo $e->getMessage();
                }
                ?>
            </div>
        </body>
    </html>
<?php
} else
    header("Location: ../index.php");
?>