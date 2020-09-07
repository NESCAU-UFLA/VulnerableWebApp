<?php
require_once("dbconfig.php");
require_once("../model/Usuario.php");

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
     * Método responsável por recuperar todas as postagens do banco
     * @return mixed[] O array contendo as postagens e seus respectivos escritores
     */
    public function recuperarTodos() {
        $con = openCon();
        $query = "SELECT * FROM Forum.Postagem AS P INNER JOIN Forum.Usuario AS U WHERE "
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
                 ."P.Mensagem LIKE '%".$mensagem."%';";
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