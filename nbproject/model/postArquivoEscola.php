<?php
include_once '../dao/DaoDriverConexao.class.php';
include_once '../dao/DaoEscola.class.php';
include_once '../entity/Escola.class.php';
$uploaddir = '../';
$uploadfile = $uploaddir . $_FILES['arquivoEscola']['name'];
print "<pre>";
if (move_uploaded_file($_FILES['arquivoEscola']['tmp_name'], $uploaddir . $_FILES['arquivoEscola']['name'])) 
{
    
    //abre o arquivo e salva o conteúdo em uma string
$handle = @fopen($uploadfile, "r");
if ($handle) {
    while (!feof($handle)) {
        
        $buffer = fgets($handle, 4096);
        
        $arrEscolas = explode(";", $buffer);
        
        $escola = new Escola($arrEscolas[0], $arrEscolas[1], $arrEscolas[2]);
        
        $DAO = new EscolaDAO();
        
        $DAO ->Insere($escola);
        
        echo $buffer;
    }
    fclose($handle);
    echo '<script> alert("O arquivo foi carregado com sucesso!") </script>';
}
    
    
} 
else 
{
    echo '<script> alert("O arquivo não foi carregado!") </script>';
    echo '<script>location.href="../view/formArquivo.php"</script>';
}
print "</pre>";
?>
