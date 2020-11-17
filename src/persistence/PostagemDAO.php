<?php
require_once("dbconfig.php");
require_once("../model/Usuario.php");

/**
 * Entidade responsável por manipular as postagens no banco de dados
 */
class PostagemDAO {
    /**
     * Método responsável por inserir uma postagem do usuário no banco
     * @param Usuario $usuario O autor da postagem
     */
    public function inserir(Usuario $usuario) {
        $con = openCon();
        $postagem = $usuario->getPostagemAtual();
        $query = "INSERT INTO Forum.Postagem(IdUsuario, Mensagem, DataPostagem, UltimaEdicao) VALUES ("
                 .$usuario->getId().", "
                 ."'".$postagem->getMensagem()."', "
                 ."'".$postagem->getDataPostagem()."', "
                 ."'".$postagem->getDataUltimaEdicao()."');";
        mysqli_query($con, $query);
        closeCon($con);
    }

    /**
     * Método responsável por atualizar uma postagem do banco
     * @param Postagem $postagem A postagem a ser atualizada
     */
    public function atualizar(Postagem $postagem) {
        $con = openCon();
        $query = "UPDATE Forum.Postagem SET "
                 ."Mensagem = '".$postagem->getMensagem()."', "
                 ."UltimaEdicao = '".$postagem->getDataUltimaEdicao()."' "
                 ."WHERE IdPostagem = ".$postagem->getId().";";
        mysqli_query($con, $query);
        closeCon($con);
    }

    /**
     * Método responsável por excluir uma postagem do banco
     * @param Postagem $postagem A postagem a ser excluída
     */
    public function excluir(Postagem $postagem) {
        $con = openCon();
        $query = "DELETE FROM Forum.Postagem WHERE "
                 ."IdPostagem = ".$postagem->getId().";";
        mysqli_query($con, $query);
        closeCon($con);
    }

    /**
     * Método responsável por recuperar todas as postagens do banco
     * @return mixed[] O array contendo as postagens e seus respectivos escritores
     */
    public function recuperarTodas() {
        $con = openCon();
        $query = "SELECT * FROM Forum.Postagem AS P INNER JOIN Forum.Usuario AS U ON "
                 ."P.IdUsuario = U.IdUsuario ORDER BY IdPostagem ASC;";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res) > 0)
            $rows = mysqli_fetch_all($res);
        else
            $rows = [];
        closeCon($con);
        return $rows;
    }

    /**
     * Método responsável por recuperar as postagens de um dado usuário
     * @param Usuario $usuario O autor das postagens
     */
    public function recuperarPorUsuario(Usuario $usuario) {
        $con = openCon();
        $query = "SELECT IdPostagem, Mensagem, DataPostagem, UltimaEdicao FROM Forum.Postagem WHERE "
                 ."IdUsuario = ".$usuario->getId()." ORDER BY IdPostagem DESC;";
        $res = mysqli_query($con, $query);
        $postagens = [];
        foreach (mysqli_fetch_all($res) as $row) {
            $postagem = new Postagem();
            $postagem->Construtor($row);
            $postagens[] = $postagem;
        }
        closeCon($con);
        $usuario->setPostagens($postagens);
    }

    /**
     * Método responsável por recuperar uma postagem pelo seu id
     * @param int $id O id da postagem
     * @return Postagem A postagem
     * @throws Exception Caso tenha ocorrido algum erro
     */
    public function recuperarPorId($id) {
        $con = openCon();
        $query = "SELECT IdPostagem, Mensagem, DataPostagem, UltimaEdicao FROM Forum.Postagem WHERE "
                 ."IdPostagem = ".$id.";";
        $res = mysqli_query($con, $query);
        if (!$res)
            throw new Exception("Erro: ".mysqli_error($con)."<br/>Na query: ".$query);
        $postagem = new Postagem();
        $postagem->Construtor(mysqli_fetch_array($res));
        closeCon($con);
        return $postagem;
    }

    /**
     * Método responsável por recuperar todas as postagens do banco
     * @param string $mensagem A mensagem a ser buscada
     * @return mixed[] O array contendo as postagens e seus respectivos escritores
     */
    public function recuperarPorMensagem(string $mensagem) {
        $con = openCon();
        $query = "SELECT * FROM Forum.Postagem AS P INNER JOIN Forum.Usuario AS U ON "
                 ."P.IdUsuario = U.IdUsuario WHERE "
                 ."P.Mensagem LIKE '%".$mensagem."%' ORDER BY IdPostagem DESC;";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res) > 0)
            $rows = mysqli_fetch_all($res);
        else
            $rows = [];
        closeCon($con);
        return $rows;
    }
}
?>