<?php
include_once("dbconfig.php");
include_once("../model/Usuario.php");

class PostagemDAO {
    /**
     * Método responsável por inserir um usuário no banco
     * @param Usuario $usuario Um usuário
     * @throws Exception Se o já existir no banco algum usuário com o mesmo login
     */
    public function inserir($usuario) {
        $con = openCon();
        
        closeCon($con);
    }
}
?>