<?php
require_once("../model/Usuario.php");
require_once("../persistence/UsuarioDAO.php");
require_once("../persistence/PostagemDAO.php");

/**
 * Função responsável por listar um dado vetor de postagens
 * @param array $postagens As postagens a serem listadas
 * @param Usuario $usuario O autor da postagem, caso for visualizado em seu perfil
 */
function listarPostagens(array $postagens, Usuario $autor = null) {
    $ehPar = true;
    $color = "";
    if ($autor != null)
        $postagens = $autor->getPostagens();
    foreach ($postagens as $post) {
        if ($ehPar)
            $color = "#e8e8e8";
        else
            $color = "white";
        $ehPar = !$ehPar;
        if ($autor != null) {
?>
            <a href="post.php?id=<?php echo $post->getId(); ?>" style="text-decoration: none; color: black;">
                <div class="post-content" style="background-color: <?php echo $color; ?>;">
                    <?php echo '['.$post->getDataPostagem().'] '.$autor->getNome().' escreveu:<br/>'.$post->getMensagem(); ?>
                </div>
            </a>
        <?php
        } else {
        ?>
            <a href="post.php?id=<?php echo $post[0]; ?>" style="text-decoration: none; color: black;">
                <div class="post-content" style="background-color: <?php echo $color; ?>;">
                    <?php echo '['.$post[3].'] '.$post[7].' escreveu:<br/>'.$post[2]; ?>
                </div>
            </a>
        <?php
        }
    }
}

/**
 * Função responsável por recuperar e mostrar todas as postagens
 */
function mostrarTodasPostagens() {
    $postagens = (new PostagemDAO())->recuperarTodas();
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
                <button style="float: left;">Voltar ao Início</button>
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
 * Função responsável por mostrar as postagens do usuário em seu perfil
 */
function mostrarPostagensDoUsuario() {
    global $usuario;
    (new PostagemDAO())->recuperarPorUsuario($usuario);
?>
    <div class="post-container" style="height: 250px;">
        <?php listarPostagens([], $usuario); ?>
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
        $usuario = unserialize($_SESSION['usuario']);
        if ($usuario->getId() == $autor->getId())
            $_SESSION['usuario'] = serialize($autor);
?>
        <div class="containerCenter shadow-box" style="background-color: white; width: 640px; height: 350px;">
            <div style="min-width: 200px;">
                <a href="home.php">
                    <button style="float: left;">Voltar ao Início</button>
                </a>
                <div style="text-align: center; padding-left: 35px;">
                    <div class="user-img" style="margin-top: 50px;">
                        <?php echo '<img src="../uploads/'.$autor->getFoto().'" />'; ?>
                    </div><br/>
                    <h4>
                        <?php echo $autor->getNome(); ?>
                    </h4>
                    <form method="POST" action="perfil.php">
                        <input type="hidden" name="idUsuario" value="<?php echo $autor->getId(); ?>" />
                        <button type="submit">Ver perfil</button>
                    </form>
                    <?php
                    if ($usuario->getId() == 1 || $usuario->getId() == $autor->getId()) {
                        $_SESSION['postId'] = $id;
                        if ($usuario->getId() == $autor->getId())
                            echo '<button id="editPostButton" onclick="mostrarFormEditarPost();">Editar postagem</button>';
                    ?>
                        <br/><br/>
                        <form method="POST" action="../controller/postagem.php">
                            <input type="hidden" name="Postagem" value="Excluir" />
                            <button type="submit">Excluir postagem</button>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div style="min-width: 400px; padding: 20px; padding-top: 30px;">
                <div id="post-content">
                    <div class="post-content" style="text-align: justify;">
                        <?php echo '" '.$autor->getPostagemAtual()->getMensagem().' "'; ?>
                    </div><br/>
                    <div>
                        Postado em: <?php echo $autor->getPostagemAtual()->getDataPostagem(); ?>
                        <br/>
                        <?php
                        $dataUltimaEdicao = $autor->getPostagemAtual()->getDataUltimaEdicao();
                        if ($dataUltimaEdicao != "")
                            echo 'Última edição em: '.$dataUltimaEdicao;
                        ?>
                    </div>
                </div>
                <div id="editPostForm" style="display: none; text-align: center; padding-top: 30px;">
                    <form method="POST" action="../controller/postagem.php">
                        <input type="hidden" name="Postagem" value="Editar" />
                        <textarea name="Mensagem" style="height: 120px;" required ><?php echo $autor->getPostagemAtual()->getMensagem(); ?></textarea><br/><br/>
                        <button type="submit">Salvar alterações</button>
                    </form><br/><br/>
                    <button onclick="esconderFormEditarPost();">Cancelar</button>
                </div>
            </div>
        </div>
<?php
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * Função responsável por adicionar a coluna de edição de senha e resultados para o dono do perfil
 */
function colunaDeEdicaoPerfil() {
    if (!isset($_POST['idUsuario'])) {
?>
        <div class="inner-column" style="padding-top: 30px; margin-right: 20px;">
            <div id="resultado">
                <?php mostrarMensagemDeResultado(); ?>
            </div>
            <div id="formSenha" style="display: none;">
                <form method="POST" action="../controller/usuario.php">
                    <input type="hidden" name="Usuario" value="EditarSenha" />
                    <input type="password" autocomplete="new-password" name="Senha" placeholder="Senha" required /><br/>
                    <input type="password" autocomplete="new-password" name="Confirmar" placeholder="Confirmar senha" required /><br/><br/>
                    <button type="submit" onclick="return validarSenha();">Alterar senha</button>
                </form>
            </div>
        </div>
<?php
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

/**
 * Verifica se quem está visitando o perfil é um outro usuário para atualizar as informações a serem mostradas na página
 */
function verificarVisitanteDoPerfil() {
    global $admin;
    global $usuario;
    // Se quem está acessando o perfil é o administrador ...
    if ($usuario->getId() == 1)
        $admin = true;
    // Caso seja um visitante no perfil ...
    if (isset($_POST['idUsuario'])) {
        if ($_POST['idUsuario'] != $usuario->getId()) {
            // Atualize o usuário para que se possa mostrar as informações dele
            $usuario = (new UsuarioDAO())->recuperarPorId($_POST['idUsuario']);
        } else
            unset($_POST['idUsuario']);
    }
}

/**
 * Função responsável por mostrar os dados do perfil do usuário
 * Também permite a edição e exclusão do perfil, caso seja o seu respectivo dono
 * Caso seja o administrador, permite a exclusão dos usuários com exceção de si mesmo.
 */
function mostrarDadosDoPerfil() {
    global $admin;
    global $usuario;
    echo '<h4>Nome: '.$usuario->getNome().'</h4>';
    if (!isset($_POST['idUsuario']) || $admin) {
        echo '<h4>Usuário: '.$usuario->getLogin().'</h4>';
        if (!isset($_POST['idUsuario'])) {
            echo '<button onclick="mostrarFormDados();">Editar dados</button>';
            // O administrador não pode excluir sua própria conta
            if (!$admin) {
            ?>
                <form method="POST" action="../controller/usuario.php"><br/>
                    <input type="hidden" name="Usuario" value="Excluir" />
                    <button type="submit">Excluir conta</button>
                </form>
            <?php
            }
        } else if (isset($_POST['idUsuario']) && $admin) {
        ?>
            <form method="POST" action="../controller/usuario.php"><br/>
                <input type="hidden" name="Usuario" value="Excluir" />
                <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>" />
                <button type="submit">Excluir conta</button>
            </form>
        <?php
        }
    }
}
?>