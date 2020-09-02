<?php

/**
 * Entidade responsável por armazenar as informações das postagens do usuário
 */
class Postagem {
    private $id;
    private $mensagem;
    private $dataDaPostagem;
    private $dataUltimaEdicao;

    /**
     * Inicializa a postagem com valores padrão
     */
    function __construct() {
        $this->id = 0;
        $this->mensagem = "";
        $this->dataDaPostagem = "";
        $this->dataUltimaEdicao = "";
    }

    /**
     * Método responsável por construir a postagem a partir de um array de argumentos
     * @param array $args O array de argumentos
     */
    public function Construtor(array $args) {
        $this->id = $args[0];
        $this->mensagem = $args[1];
        $this->dataDaPostagem = $args[2];
        $this->dataUltimaEdicao = $args[3];
    }

    /**
     * Método que retorna o id da postagem
     * @return int $id O id do post
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Método que retorna a mensagem da postagem
     * @return string $mensagem A mensagem
     */
    public function getMensagem() {
        return $this->mensagem;
    }

    /**
     * Método que retorna a data da postagem
     * @return string $dataDaPostagem A data da postagem
     */
    public function getDataPostagem() {
        return $this->dataDaPostagem;
    }

    /**
     * Método que retorna a data da última edição da postagem
     * @return string $dataUltimaEdicao A data da última edição da postagem
     */
    public function getDataUltimaEdicao() {
        return $this->dataUltimaEdicao;
    }

    /**
     * Método responsável por definir a mensagem da postagem
     * @param string $mensagem A mensagem
     * @param bool $editar Indica se a mensagem está em estado de edição ou não
     */
    public function setMensagem(string $mensagem, bool $editar = false) {
        $this->mensagem = $mensagem;
        if (!$editar)
            $this->dataDaPostagem = date("d/m/Y H:i");
        else
            $this->dataUltimaEdicao = date("d/m/Y H:i");
    }
}
?>