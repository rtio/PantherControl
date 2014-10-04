<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoTrajeto.class.php';

if(!empty($_GET['id_trajeto']))
{

    $DAO = new TrajetoDAO();

    $DAO->Deleta($_GET['id_trajeto']);
    
    echo '<script>location.href="../view/formHome.php"</script>';
}

?>
