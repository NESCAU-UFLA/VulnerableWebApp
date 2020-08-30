<?php
    include("../model/Usuario.php");
    include("../persistence/UsuarioDAO.php");

    /** Constante que representa o diretório das imagens */
    define("USER_IMG_PATH", "/var/www/html/VulnerableWebApp/uploads/");
    
    session_start();

    /**
     * Função responsável por fazer o upload da imagem
     * @return string O nome da imagem
     */
    function carregarFoto() {
        $imgName = "";
        if (!empty($_FILES['foto']['name'])) {
            $imgName = basename($_FILES['foto']['name']);
            $imgDir = USER_IMG_PATH.$imgName;
            $imgType = strtolower(pathinfo($imgDir, PATHINFO_EXTENSION));
            $nameAux = basename($_FILES['foto']['name'], '.'.$imgType);
            $i = 0;
            while (file_exists($imgDir)) {
                $imgName = $nameAux.'('.$i.').'.$imgType;
                $imgDir = USER_IMG_PATH.$imgName;
                ++$i;
            }
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $imgDir))
                die("Nao foi possivel fazer o upload da imagem!");
        } else
            $imgName = "default.png";
        return $imgName;
    }

    /**
     * Função responsável por realizar o cadastro de um usuário
     */
    function cadastrar() {
        $usuario = new Usuario();
        $usuario->Construtor(array(0, $_POST['Login'], $_POST['Nome'], $_POST['Senha'], carregarFoto()));
        try {
            (new UsuarioDAO())->inserir($usuario);
            $_SESSION['resultado'] = [];
            $_SESSION['resultado'][] = true;
            $_SESSION['resultado'][] = "Cadastro efetuado com sucesso! Faça login...";
            header("Location: ../view/index.php");
        } catch (Exception $e) {
            if (!empty($_FILES['foto']['name']))
                unlink(USER_IMG_PATH.$usuario->getFoto());
            $_SESSION['resultado'] = $e->getMessage();
            header("Location: ../view/cadastrar.php");
        }
    }

    /**
     * Função responsável por realizar o login de um usuário
     */
    function login() {
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
     * Função responsável por finalizar a sessão de um usuário
     */
    function logout() {
        unset($_SESSION['usuario']);
        header("Location: ../view/index.php");
    }

    function editarFoto() {
        $usuario = unserialize($_SESSION['usuario']);
        $usuario->setFoto(carregarFoto());
    }

    if (isset($_POST['Usuario'])) {
        switch($_POST['Usuario']) {
            case 'Cadastrar':
                cadastrar();
                break;
            case 'Login':
                login();
                break;
            case "Logout":
                logout();
                break;
            case "EditarFoto":
                editarFoto();
                break;
        }
    }
?>