<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoEscola.class.php';
include_once '../entity/Escola.class.php';

if(!empty($_POST['codEscola']) && !empty($_POST['nome']) && !empty($_POST['endereco']))
{
    $escola = new Escola($_POST['codEscola'], $_POST['nome'], $_POST['endereco']);

    $DAO = new EscolaDAO();

    $DAO ->Insere($escola);
    
    echo '<script>location.href="../view/formEscola.php"</script>';
}

?>