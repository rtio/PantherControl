<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoEscola.class.php';

// Verifica se existe a vari�vel txtnome
if (isset($_GET["pesquisa"])) {
    $codEscola = $_GET["pesquisa"];
    // Conexao com o banco de dados
	$DAO = new EscolaDao();
   foreach ($DAO->Lista("SELECT * FROM tb_escola WHERE codEscola = '$codEscola'") as $row){
echo $row["endereco"];
}
}
?>