<?php
include_once("../config/geral.php");

/**
 * Função que abre uma conexão com o banco e a retorna
 * @return mixed A conexxão
 */
function openCon() {
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME;
    $con = mysqli_connect(
        $DB_HOST,
        $DB_USER,
        $DB_PASS,
        $DB_NAME
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
