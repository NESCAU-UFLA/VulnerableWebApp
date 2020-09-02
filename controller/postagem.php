<?php
include_once("../model/Usuario.php");
include_once("../persistence/PostagemDAO.php");

session_start();

class PostagemController {
    public function inserir() {
        $usuario = unserialize($_SESSION['usuario']);
        $usuario->cadastrarPostagem($_POST['Mensagem']);
        (new PostagemDAO())->inserir($usuario);
        header("Location: ../view/home.php");
    }
}

$controller = new PostagemController();

if (isset($_POST['Postagem'])) {
    switch($_POST['Postagem']) {
        case 'Inserir':
            $controller->inserir();
            break;
    }
}
?>