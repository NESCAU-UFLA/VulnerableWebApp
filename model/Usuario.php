<?php
include_once("Postagem.php");

/**
 * Entidade responsável por armazenar as informações do usuário
 */
class Usuario {
    private $id;
    private $login;
    private $nome;
    private $senha;
    private $foto;
    private $postagem;

    /**
     * Inicializa os atributos com valores padrão
     */
    function __construct() {
        $this->id = 0;
        $this->login = "";
        $this->nome = "";
        $this->senha = "";
        $this->foto = "";
        $this->postagem = new Postagem();
    }

    /**
     * que define os valores dos atributos a partir de um array de argumentos
     * @param mixed[] $args O array de argumentos
     */
    public function Construtor(array $args) {
        $this->id = $args[0];
        $this->login = $args[1];
        $this->nome = $args[2];
        $this->senha = $args[3];
        $this->foto = $args[4];
    }

    /**
     * Método que retorna o id do usuário
     * @return int O id do usuário
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Método que retorna o login do usuário
     * @return string O login do usuário
     */
    public function getLogin() {
        return $this->login;
    }
    
    /**
     * Método que retorna o nome do usuário
     * @return string O nome do usuário
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Método que retorna a senha do usuário
     * @return string A senha do usuário
     */
    public function getSenha() {
        return $this->senha;
    }
    
    /**
     * Método que retorna o nome da foto do usuário
     * @return string O nome da foto
     */
    public function getFoto() {
        return $this->foto;
    }

    /**
     * Método que retorna a última postagem do usuário
     * @return Postagem A postagem do usuário
     */
    public function getPostagem() {
        return $this->postagem;
    }

    /**
     * Método que define o novo login do usuário
     * @param string $login O login do usuário
     */
    public function setLogin(string $login) {
        $this->login = $login;
    }

    /**
     * Método que define o novo nome do usuário
     * @param string $nome O nome do usuário
     */
    public function setNome(string $nome) {
        $this->nome = $nome;
    }

    /**
     * Método que define a nova senha do usuário
     * @param string $senha A senha do usuário
     */
    public function setSenha(string $senha) {
        $this->senha = $senha;
    }

    /**
     * Método que define o novo nome da foto do usuário
     * @param string $foto O nome da foto
     */
    public function setFoto(string $foto) {
        $this->foto = $foto;
    }

    public function setPostagem(Postagem $postagem) {
        $this->postagem = $postagem;
    }

    /**
     * Método que define a última postagem do usuário
     */
    public function adicionarPostagem(string $mensagem) {
        $this->postagem->setMensagem($mensagem);
    }

    /**
     * Método que define a última edição numa postagem do usuário
     */
    public function editarPostagem(string $mensagem) {
        $this->postagem->setMensagem($mensagem, true);
    }
}
?>