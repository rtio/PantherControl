<?php
$title = "Cadastro de usuário";
$activeArquivo = "active";
include_once 'modal.php';
function content(){
?>
<script src="../static/js/jquery.min.js"></script>
<script src="../static/bootstrap/js/bootstrap.min.js"></script>
<form enctype="multipart/form-data" class="form-horizontal" action="../model/postArquivoEscola.php" method="post">
        <a data-toggle="modal" href="#myModal" class="pull-right"><span id="ajuda" class="glyphicon glyphicon-question-sign"></span>Ajuda</a>
        </br>
        </br>
    <input type="file" class="form-control" name="arquivoEscola">
    </br>
            <button type="submit" id="enviar" class="btn btn-primary btn-lg btn-block">
                <span class="glyphicon glyphicon-cloud-upload"></span> Enviar
            </button>
            <button type="reset" id="limpar" class="btn btn-danger btn-lg btn-block">
                <span class="glyphicon glyphicon-eject"></span> Limpar
            </button>
</form>

<script>
$('#ajuda').tooltip();
$('#a').popover();
</script>
<?php
$content = "<p>O arquivo deve estar no formato .txt, as colunas serão separadas por Ponto e Vírgula. Exemplo com a ordem das colunas: </br><b>COD_ESCOLA;NOME_ESCOLA;ENDERECO_ESCOLA;BAIRRO_ESCOLA</b></p>";
modal("myModal", "Ajuda", $content);
}
include_once 'template.php';
?>