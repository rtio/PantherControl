<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoUsuario.class.php';
$DAO = new UsuarioDAO();

$email = $_POST['email'];

$senha = $_POST['senha'];

$senha = sha1(md5($senha));

foreach ($DAO->Lista("SELECT * FROM `tb_usuario`") as $usuario) 
{
    if($usuario['email'] == $email && $usuario['senha'] == $senha)
    {   
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("location: ../view/formHome.php");
    }else
        {
            echo '<script>
             alert("Login incorreto!");
             location.href="../index.html";
             </script>';
        }

}
