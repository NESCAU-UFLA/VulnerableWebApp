<?php
/**
 * Entidade responsável por armazenar as informações das postagens do usuário
 */
class Postagem {
    private $id;
    private $mensagem;
    private $dataDaPostagem;
    private $dataUltimaEdicao;

    function __construct() {
        $this->id = 0;
        $this->mensagem = "";
        $this->dataDaPostagem = "";
        $this->dataUltimaEdicao = "";
    }

    public function Construtor(array $args) {
        $this->id = $args[0];
        $this->mensagem = $args[1];
        $this->dataDaPostagem = $args[2];
        $this->dataUltimaEdicao = $args[3];
    }

    /**
     * Método responsável por definir a mensagem da postagem
     * @param string $mensagem A mensagem
     * @param bool $editar Indica se a mensagem está em estado de edição ou não
     */
    public function setMensagem(string $mensagem, bool $editar = false) {
        $this->mensagem = $mensagem;
        if (!$editar)
            $this->dataDaPostagem = time("d/m/Y H:i");
        else
            $this->dataUltimaEdicao = time("d/m/Y H:i");
    }
}
?>