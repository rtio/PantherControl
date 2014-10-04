<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoUsuario.class.php';
include_once '../entity/Usuario.class.php';

if(!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['endereco']) && !empty($_POST['bairro']) && !empty($_POST['cidade']) && !empty($_POST['estado']))
{
    $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['endereco'], $_POST['bairro'], $_POST['cidade'], $_POST['estado']);

    $DAO = new UsuarioDAO();

    $DAO ->Insere($usuario);
    
    echo '<script>location.href="../view/formUsuario.php"</script>';
}

?>
