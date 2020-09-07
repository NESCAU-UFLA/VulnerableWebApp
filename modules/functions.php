<?php
require_once("../model/Usuario.php");
require_once("../persistence/UsuarioDAO.php");
require_once("../persistence/PostagemDAO.php");

/**
 * Função responsável por listar um dado vetor de postagens
 * @param array $postagens As postagens a serem listadas
 */
function listarPostagens(array $postagens) {
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
 * Função responsável por recuperar e mostrar todas as postagens
 */
function mostrarTodasPostagens() {
    $postagens = (new PostagemDAO())->recuperarTodos();
?>
    <div class="post-container" style="height: 250px;">
        <?php listarPostagens($postagens); ?>
    </div>
<?php
}

/**
 * Função responsável por recuperar e mostrar as postagens que contenham uma dada mensagem
 * @param string $msg A mensagem a ser buscada
 */
function mostrarPostagensPorMensagem(string $msg) {
    $postagens = (new PostagemDAO())->recuperarPorMensagem($msg);
?>
    <div class="containerCenter shadow-box" style="background-color: white; width: 600px; height: 350px; padding-bottom: 20px; padding-right: 20px;">
        <div style="width: 100%;">
            <a href="home.php">
                <button style="float: left;">Voltar</button>
            </a><br/><br/>
            <h2 style="margin-left: 40px;">
                Resultados da pesquisa para: <?php echo $msg; ?>
            </h2>
            <div class="post-container" style="height: 200px; width: 90%; margin: 40px;">
                <?php listarPostagens($postagens); ?>
            </div>
        </div>
    </div>
<?php
}

/**
 * Função responsável por recuperar e mostrar uma postagem
 * @param int $id O id da postagem
 */
function mostrarPostagemPorId($id) {
    try {
        $autor = (new UsuarioDAO())->recuperarPorIdPost($id);
        $autor->setPostagemAtual((new PostagemDAO())->recuperarPorId($id));
?>
        <div class="containerCenter shadow-box" style="background-color: white; width: 600px; height: 300px;">
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
        </div>
<?php
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * Função responsável por mostrar se uma ação foi bem sucedida ou não
 */
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