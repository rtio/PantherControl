<?php
include_once '../entity/Escola.class.php';
include_once '../dao/DaoUsuario.class.php';
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoEscola.class.php';
include_once '../util/DataTransfer.class.php';
include_once '../chat/config.php';
include_once '../chat/conexao_singleton/BD.class.php';
BD::conn();

$DAO = new UsuarioDAO();

$email = $_POST['email'];

$senha = $_POST['senha'];

$senha = sha1(md5($senha));

    
/*if (!file_exists("../transf/esistema.txt")) {
    echo '<script>
             alert("Monitor parado. Contate o administrador do sistema!");
             location.href="../index.html";
             </script>';
}*/


foreach ($DAO->Lista("SELECT * FROM `tb_usuario`") as $usuario) 
{

        if($usuario['email'] == $email && $usuario['senha'] == $senha)
        {   
            
            $atual = date('Y-m-d H:i:s');
            $expira = date('Y-m-d H:i:s', strtotime('+1 min'));
            $update = BD::conn()->prepare("UPDATE `tb_usuario` SET horario = ?, limite = ? WHERE email = ?");
            $update->execute(array($atual, $expira, $usuario['email']));
            
/*            $transfer = new DataTransfer();
		
            $transfer->getData("../transf/esistema.txt", $usuario['id_usuario']);*/
            
            session_start();
        
            $_SESSION['usuario'] = $usuario;
		
            echo '<script>location.href="../view/formHome.php";</script>';
        
        }
}
 echo '<script>
             alert("Login incorreto!");
             location.href="../index.html";
             </script>';
