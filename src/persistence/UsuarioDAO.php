<?php
require_once("dbconfig.php");
require_once("../model/Usuario.php");

/**
 * Entidade responsável por manipular os usuários no banco de dadoss
 */
class UsuarioDAO {
    /**
     * Método responsável por inserir um usuário no banco
     * @param Usuario $usuario O usuário a ser inserido
     * @throws Exception Se já existir no banco algum usuário com o mesmo login
     */
    public function inserir(Usuario $usuario) {
        $con = openCon();
        $query = "SELECT * FROM Forum.Usuario WHERE Login = '".$usuario->getLogin()."';";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res) == 1)
            throw new Exception("Já existe um usuário com este login!");
        $query = "INSERT INTO Forum.Usuario(Login, Nome, Senha, Foto) VALUES("
                 ."'".$usuario->getLogin()."', "
                 ."'".$usuario->getNome()."', "
                 ."'".$usuario->getSenha()."', "
                 ."'".$usuario->getFoto()."'"
                 .");";
        $res = mysqli_query($con, $query);
        closeCon($con);
    }

    /**
     * Método responsável por autenticar um usuário
     * @param Usuario $usuario O usuário a ser autenticaado
     * @throws Exception Se o login ou a senha forem inválidos
     */
    public function login(Usuario $usuario) {
        $con = openCon();
        $query = "SELECT * FROM Forum.Usuario WHERE "
                 ."Login = '".$usuario->getLogin()."' AND "
                 ."Senha = '".$usuario->getSenha()."';";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res) == 0)
            throw new Exception("Usuário ou senha inválidos.");
        $usuario->Construtor(mysqli_fetch_row($res));
        closeCon($con);
    }
    
    /**
     * Método responsável por atualizar um usuário
     * @param Usuario $usuario O usuário a ser atualizado
     * @throws Exception Se o nome de usuário inserido já estiver sendo em uso por outro
     */
    public function atualizar(Usuario $usuario) {
        $con = openCon();
        $query = "SELECT * FROM Forum.Usuario WHERE "
                 ."IdUsuario = ".$usuario->getId()." AND "
                 ."Login = '".$usuario->getLogin()."';";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res) == 0) {
            $query = "SELECT * FROM Forum.Usuario WHERE "
                     ."Login = '".$usuario->getLogin()."';";
            $res = mysqli_query($con, $query);
            if (mysqli_num_rows($res) == 1)
                throw new Exception("Este nome de usuário já está em uso.");
        }
        $query = "UPDATE Forum.Usuario SET "
                 ."Login = '".$usuario->getLogin()."', "
                 ."Nome = '".$usuario->getNome()."', "
                 ."Senha = '".$usuario->getSenha()."', "
                 ."Foto = '".$usuario->getFoto()."' "
                 ."WHERE IdUsuario = ".$usuario->getId().";";
        mysqli_query($con, $query);
        closeCon($con);
    }

    /**
     * Método responsável por excluir um usuário do banco
     * @param Usuario $usuario O usuário a ser excluído
     */
    public function excluir(Usuario $usuario) {
        $con = openCon();
        $query = "DELETE FROM Forum.Usuario WHERE "
                 ."IdUsuario = ".$usuario->getId().";";
        mysqli_query($con, $query);
        closeCon($con);
    }

    /**
     * Método responsável por recuperar um usuário através do seu id no banco
     * @param int $id O id do usuário
     * @return Usuario O usuário a ser recuperado
     */
    public function recuperarPorId(int $id) {
        $con = openCon();
        $query = "SELECT * FROM Forum.Usuario WHERE "
                 ."IdUsuario = ".$id.";";
        $res = mysqli_query($con, $query);
        $usuario = new Usuario();
        $usuario->Construtor(mysqli_fetch_array($res));
        closeCon($con);
        return $usuario;
    }

    /**
     * Método responsável por recuperar um usuário através do id de sua postagem
     * @param int $idPost O id da postagem
     * @return Usuario O autor da postagem
     * @throws Exception Caso tenha ocorrido algum erro na query
     */
    public function recuperarPorIdPost($idPost) {
        $con = openCon();
        $query = "SELECT U.* FROM Forum.Postagem AS P INNER JOIN Forum.Usuario AS U ON "
                 ."P.IdUsuario = U.IdUsuario WHERE "
                 ."P.IdPostagem = ".$idPost.";";
        $res = mysqli_query($con, $query);
        if (!$res)
            throw new Exception("Erro: ".mysqli_error($con)."<br/>Na query: ".$query);
        $usuario = new Usuario();
        $usuario->Construtor(mysqli_fetch_array($res));
        closeCon($con);
        return $usuario;
    }
}
?>