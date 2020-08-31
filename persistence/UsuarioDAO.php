<?php
    include_once("dbconfig.php");
    include_once("../model/Usuario.php");

    class UsuarioDAO {
        /**
         * Método responsável por inserir um usuário no banco
         * @param Usuario $usuario Um usuário
         * @throws Exception Se o já existir no banco algum usuário com o mesmo login
         */
        public function inserir($usuario) {
            $con = openCon();
            $query = "SELECT * FROM Forum.Usuario WHERE Login = '".$usuario->getLogin()."';";
            $res = mysqli_query($con, $query);
            if (mysqli_num_rows($res) == 1)
                throw new Exception("Já existe um usuário com este login!");
            $query = "INSERT INTO Forum.Usuario("
                ."Login, Nome, Senha, Foto"
            .") VALUES("
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
         * @param Usuario $usuario Um usuário
         * @throws Exception Se o login ou a senha forem inválidos
         */
        public function login($usuario) {
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

        public function atualizarDados($usuario) {
            $con = openCon();
            $query = "SELECT * FROM Forum.Usuario WHERE "
                ."IdUsuario = ".$usurio->getId()." AND "
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
                ."Nome = '".$usuario->getNome()."', ";
            closeCon($con);
        } 
    }
?>