<?php 
session_start();
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoEscola.class.php';

/*$usuario =  $_SESSION['usuario'];

$DAO = new EscolaDAO();

$DAO->Deleta($usuario['id_usuario']);*/

session_unset($_SESSION['usuario']);

echo '<script>location.href="../index.html";</script>';
?>
