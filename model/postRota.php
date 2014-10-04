<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoTrajeto.class.php';
include_once '../entity/Trajeto.class.php';

if(!empty($_POST['ponto2persist']) && !empty($_POST['dist_12']) && !empty($_POST['dist_23']) && !empty($_POST['dist_total']) && !empty($_POST['data']) && !empty($_POST['periodo']) && !empty($_POST['id_usuario']) && !empty($_POST['veiculo']) && !empty($_POST['diferenca']))
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
    
    
    //verifica se está saindo ou voltando para casa, para dar a difereça na quilomentragem
    if($ponto1 == "CASA"){
        $count = 1;
    }
    if($ponto3 == "CASA"){
        $count += 1;
    }
    if($count == 1){
        $diferenca = $_POST['diferenca'];
    }elseif($count == 2){
        $diferenca = $_POST['diferenca'] * 2;
    }else{
        $diferenca = 0;
    }
       
    
        
    $trajeto = new Trajeto($ponto1, utf8_decode($_POST['ponto2persist']), $ponto3, $_POST['dist_12'], $_POST['dist_23'], $_POST['dist_total'], $_POST['data'], $_POST['periodo'], $_POST['id_usuario'], $_POST['veiculo'], $diferenca);
    
    $DAO = new TrajetoDAO();

    $DAO ->Insere($trajeto);
    
  //  echo '<script>location.href="../view/formRota.php"</script>';
}


    
?>
