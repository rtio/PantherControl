<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoTrajeto.class.php';
include_once '../entity/Trajeto.class.php';

if(!empty($_POST['ponto2persist']) && !empty($_POST['dist_12']) && !empty($_POST['dist_23']) && !empty($_POST['dist_total']) && !empty($_POST['data']) && !empty($_POST['periodo']) && !empty($_POST['id_usuario']) && !empty($_POST['veiculo']))
{
    if(!empty($_POST['ponto1persist']))
    {
        $ponto1 = $_POST['ponto1persist'];
    }else
    {
        $ponto1 = $_POST['ponto1-1persist'];
    }
    if(!empty($_POST['ponto3persist']))   
    {
        $ponto3 = $_POST['ponto3persist'];
    }else
    {
        $ponto3 = $_POST['ponto3-1persist'];
    }
          
        
    $trajeto = new Trajeto($ponto1, $_POST['ponto2persist'], $ponto3, $_POST['dist_12'], $_POST['dist_23'], $_POST['dist_total'], $_POST['data'], $_POST['periodo'], $_POST['id_usuario'], $_POST['veiculo']);
    
    $DAO = new TrajetoDAO();

    $DAO ->Insere($trajeto);
    
    echo '<script>location.href="../view/formRota.php"</script>';
}


    
?>
