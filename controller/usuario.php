<?php
include("../model/Usuario.php");
include("../persistence/UsuarioDAO.php");

session_start();

class UsuarioController {
    // Constante que representa o diretório das imagens
    private $USER_IMG_PATH;

    function __construct() {
        $this->USER_IMG_PATH = "/var/www/html/VulnerableWebApp/uploads/";
    }

    /**
     * Método responsável por fazer o upload da imagem
     * @return string O nome da imagem
     */
    private function carregarFoto() {
        $imgName = "";
        if (!empty($_FILES['foto']['name'])) {
            $imgName = basename($_FILES['foto']['name']);
            $imgDir = $this->USER_IMG_PATH.$imgName;
            $imgType = strtolower(pathinfo($imgDir, PATHINFO_EXTENSION));
            $nameAux = basename($_FILES['foto']['name'], '.'.$imgType);
            $i = 0;
            while (file_exists($imgDir)) {
                $imgName = $nameAux.'('.$i.').'.$imgType;
                $imgDir = $this->USER_IMG_PATH.$imgName;
                ++$i;
            }
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $imgDir))
                die("Nao foi possivel fazer o upload da imagem!");
        } else
            $imgName = "default.png";
        return $imgName;
    }

    /**
     * Método responsável por realizar o cadastro de um usuário
     */
    public function cadastrar() {
        $usuario = new Usuario();
        $usuario->Construtor(array(0, $_POST['Login'], $_POST['Nome'], $_POST['Senha'], $this->carregarFoto()));
        error_log(var_dump($usuario->getFoto()));
        try {
            (new UsuarioDAO())->inserir($usuario);
            $_SESSION['resultado'] = [];
            $_SESSION['resultado'][] = true;
            $_SESSION['resultado'][] = "Cadastro efetuado com sucesso! Faça login...";
            header("Location: ../view/index.php");
        } catch (Exception $e) {
            if (!empty($_FILES['foto']['name']))
                unlink($this->USER_IMG_PATH.$usuario->getFoto());
            $_SESSION['resultado'] = $e->getMessage();
            header("Location: ../view/cadastrar.php");
        }
    }

    /**
     * Método responsável por realizar o login de um usuário
     */
    public function login() {
        $usuario = new Usuario();
        $usuario->Construtor(array(0, $_POST['Login'], "", $_POST['Senha'], ""));
        try {
            (new UsuarioDAO())->login($usuario);
            $_SESSION['usuario'] = serialize($usuario);
            header("Location: ../view/home.php");
        } catch (Exception $e) {
            $_SESSION['resultado'] = [];
            $_SESSION['resultado'][] = false;
            $_SESSION['resultado'][] = $e->getMessage();
            header("Location: ../view/index.php");
        }
    }

    /**
     * Método responsável por finalizar a sessão de um usuário
     */
    public function logout() {
        unset($_SESSION['usuario']);
        header("Location: ../view/index.php");
    }

    /**
     * Método responsável por realizar os passos em comum entre as funções de editar o usuáriio
     * @param Usuario $usuario O usuário a ser editado
     * @param string $msg A mensagem de retorno para indicar que a operação foi bem sucedida
     */
    private function atualizar($usuario, $msg) {
        $_SESSION['resultado'] = [];
        try {
            (new UsuarioDAO())->atualizar($usuario);
            $_SESSION['resultado'][] = true;
            $_SESSION['resultado'][] = $msg;
            $_SESSION['usuario'] = serialize($usuario);
        } catch(Exception $e) {
            $_SESSION['resultado'][] = false;
            $_SESSION['resultado'][] = $e->getMessage();
        }
    }

    /**
     * Método responsável por atualizar a foto de um usuário
     */
    public function atualizarFoto() {
        $usuario = unserialize($_SESSION['usuario']);
        $fotoAntiga = $usuario->getFoto();
        $usuario->setFoto($this->carregarFoto());
        $this->atualizar($usuario, "Foto alterada com sucesso!");
        if ($_SESSION['resultado'][0])
            if ($fotoAntiga !== "default.png")
                unlink($this->USER_IMG_PATH.$fotoAntiga);
        header("Location: ../view/editar-dados.php");
    }

    /**
     * Método responsável por atualizar os dados básicos do usuário
     */
    public function atualizarDados() {
        $usuario = unserialize($_SESSION['usuario']);
        if (!empty($_POST['Login']))
            $usuario->setLogin($_POST['Login']);
        if (!empty($_POST['Nome']))
            $usuario->setNome($_POST['Nome']);
        $this->atualizar($usuario, "Dados alterados com sucesso!");
        header("Location: ../view/editar-dados.php");
    }

    /**
     * Método responsável por atualizar a senha do usuário
     */
    public function atualizarSenha() {
        $usuario = unserialize($_SESSION['usuario']);
        $usuario->setSenha($_POST['Senha']);
        $this->atualizar($usuario, "Senha alterada com sucesso!");
        header("Location: ../view/editar-dados.php");
    }

    /**
     * Método responsável por excluir um usuário
     */
    public function excluir() {
        (new UsuarioDAO())->excluir(unserialize($_SESSION['usuario']));
        $this->logout();
    }
}

$controller = new UsuarioController();

if (isset($_POST['Usuario'])) {
    switch($_POST['Usuario']) {
        case 'Cadastrar':
            $controller->cadastrar();
            break;
        case 'Login':
            $controller->login();
            break;
        case "Logout":
            $controller->logout();
            break;
        case "EditarFoto":
            $controller->atualizarFoto();
            break;
        case "EditarDados":
            $controller->atualizarDados();
            break;
        case "EditarSenha":
            $controller->atualizarSenha();
            break;
        case "Excluir":
            $controller->excluir();
            break;
    }
}
?>