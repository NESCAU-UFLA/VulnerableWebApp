<?php
require_once("../model/Usuario.php");
require_once("../persistence/UsuarioDAO.php");
require_once("../persistence/PostagemDAO.php");

/**
 * Função responsável por recuperar e mostrar todas as postagens
 */
function mostrarTodasPostagens() {
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
}

/**
 * Função responsável por recuperar e mostrar uma mensagem
 * @param int $id O id da postagem
 */
function mostrarPostagemPorId($id) {
    try {
        $autor = (new UsuarioDAO())->recuperarPorIdPost($id);
        $autor->setPostagemAtual((new PostagemDAO())->recuperarPorId($id));
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
}

function mostrarMensagemDeResultado() {
    if (isset($_SESSION['resultado'])) {
        if ($_SESSION['resultado'][0]) {
            echo '<p style="color: green;">'.$_SESSION['resultado'][1].'</p>';
        } else {
            echo '<p style="color: red;">'.$_SESSION['resultado'][1].'</p>';
        }
        unset($_SESSION['resultado']);
    }
}
?>