<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoEscola.class.php';

session_start();

$usuario = $_SESSION['usuario'];

$id_usuario = $usuario['id_usuario'];

// Verifica se existe a vari�vel txtnome
if (isset($_GET["pesquisa"])) {
    $codEscola = $_GET["pesquisa"];
    // Conexao com o banco de dados
	$DAO = new EscolaDao();
   foreach ($DAO->Lista("SELECT * FROM `tb_escola` WHERE `codEscola` = '$codEscola'") as $row){
echo utf8_encode($row["nome"]);
}
}
?>