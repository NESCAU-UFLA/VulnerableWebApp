<?php
include_once("dbconfig.php");
include_once("../model/Usuario.php");

class PostagemDAO {
    /**
     * Método responsável por inserir uma postagem do usuário no banco
     * @param Usuario $usuario Um usuário
     * @throws Exception Se o já existir no banco algum usuário com o mesmo login
     */
    public function inserir($usuario) {
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
}
?>