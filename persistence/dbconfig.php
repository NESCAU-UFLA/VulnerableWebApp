<?php
    /**
     * Função que abre uma conexão com o banco e a retorna
     * @return mixed A conexxão
     */
    function openCon() {
        $con = mysqli_connect(
            "127.0.0.1",
            "root",
            "root",
            "Forum"
        );
        return $con;
    }

    /**
     * Função que fecha uma dada conexão previamente aberta
     * @param mixed $con A conexão
     */
    function closeCon($con) {
        mysqli_close($con);
    }
?>
