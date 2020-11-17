<?php
require_once("../model/Usuario.php");
require_once("../persistence/PostagemDAO.php");

session_start();

class PostagemController {
    /**
     * Método responsável por inserir uma postagem
     */
    public function inserir() {
        $usuario = unserialize($_SESSION['usuario']);
        $usuario->cadastrarPostagem($_POST['Mensagem']);
        (new PostagemDAO())->inserir($usuario);
        header("Location: ../view/home.php");
    }

    /**
     * Método responsável por atualizar uma postagem
     */
    public function atualizar() {
        $usuario = unserialize($_SESSION['usuario']);
        $usuario->editarPostagemAtual($_POST['Mensagem']);
        (new PostagemDAO())->atualizar($usuario->getPostagemAtual());
        $_SESSION['resultado'] = "Mensagem atualizada com sucesso!";
        header("Location: ../view/post.php?id=".$usuario->getPostagemAtual()->getId());
    }

    /**
     * Método responsável por excluir uma postagem
     */
    public function excluir() {
        $postDAO = new PostagemDAO();
        $postDAO->excluir($postDAO->recuperarPorId($_SESSION['postId']));
        unset($_SESSION['postId']);
        header("Location: ../view/home.php");
    }
}

$controller = new PostagemController();

if (isset($_POST['Postagem'])) {
    switch($_POST['Postagem']) {
        case 'Inserir':
            $controller->inserir();
            break;
        case "Editar":
            $controller->atualizar();
            break;
        case "Excluir":
            $controller->excluir();
            break;
    }
}
?>