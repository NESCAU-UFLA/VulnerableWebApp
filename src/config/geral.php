<?php
include_once("env.php");

// Configuração do banco
$DB_HOST = $_ENV['DB_HOST'];
$DB_USER = $_ENV['DB_USER'];
$DB_PASS = $_ENV['DB_PASS'];
$DB_NAME = $_ENV['DB_NAME'];

// Configuração de diretório
define('USER_IMG_PATH', $_ENV['USER_IMG_PATH']);
?>
